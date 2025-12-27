<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Hash;
use Auth;
use Carbon\Carbon;
use DB;
// use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF; // alias from the package
use ZipArchive;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\CustomerController;

use App\Models\Company;

use App\Models\Customer;
use App\Models\CustomerUid;
use App\Models\Collection;
use App\Models\CollectionSkip;

use App\Models\Billing;
use App\Models\BillingDetail;
use App\Models\BillingDetailSkip;
use App\Models\BillingMunicipality;


class BillingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->middleware('permission:billing-list', ['only' => ['index','view']]);
        $this->middleware('permission:billing-create', ['only' => ['fetch','generate']]);
        $this->middleware('permission:billing-update', ['only' => ['update']]);
        $this->middleware('permission:invoice-generate', ['only' => ['generate_invoice_print']]);
    }
    public function index(Request $request,$customer_id = 0){
        
        $data = Billing::select(["billings.*","customers.client_id","users.name"])
        ->join("customers","customers.id","=","billings.customer_id")
        ->join("users","users.id","=","billings.generated_by")
        ->where("billings.company_id",Auth::user()->company_id);
        if($customer_id > 0){
            $data = $data->where("billings.customer_id",$customer_id);
        }
        $data = $data->orderBy("billings.generated_date","DESC")->get();
        return view('billing.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function create(){
        $customers = CustomerUid::with([
                'customer',
            ])
            ->whereHas('customer', function ($q) {
                $q->where('company_id', Auth::user()->company_id);
            })
            ->get();
        return view('billing.create',compact("customers"));
    }
    
    public function fetch_billing_record($billing_id){
         $billing = Billing::with([
                'customer_uid',
                'customer_uid.customer',
                'generated_by',
                'billing_detail',
                'billing_municipality',
                'billing_detail.collection',
                'billing_detail.collection.driver',
                'billing_detail.billing_detail_skip'
            ])->find($billing_id);
            
        // Manually add helpers to each billing_detail
        $billing->billing_detail->each(function ($detail) {
            if ($detail->collection->helper_ids) {
                $ids = array_filter(explode(',', $detail->collection->helper_ids)); // split CSV
                $detail->collection->helpers = User::whereIn('id', $ids)->get()->pluck("name")->toArray();    // fetch helpers
            } else {
                $detail->collection->helpers = collect(); // empty collection if no helpers
            }
        });
        
        $company = Company::find(Auth::user()->company_id);
        
        // echo "<pre>";
        // print_r($billing);
        // die();
        
        return (Object)["billing" => $billing , "company" => $company];
    }
    
    
    public function view($billing_id){
        $billing_record = $this->fetch_billing_record($billing_id);
        
        $billing = $billing_record->billing;
        $company = $billing_record->company;
        
        
        
        return view('billing.show',compact("billing","company"));
    }
    
    
    public function fetch(Request $request){
        $this->validate($request, [
            'billing_period' => 'required',
        ]);
        
        $date = explode(" to ",$request->input("billing_period"));
        
        
        
        $startDate = $date[0];
        
        if(isset($date[1])){
            $endDate = date('Y-m-d H:i:s', strtotime($date[1] . ' +1 day'));
        }else{
            $endDate = date('Y-m-d H:i:s', strtotime($date[0] . ' +1 day'));
        }
        
        
        // $customers = Customer::with([
        //         'customer_uid',
        //         'collections' => function ($q) use ($startDate, $endDate) {
        //             $q->whereBetween('pickup_date', [$startDate, $endDate]);
        //         },
        //         'collections.collectionSkips'
        //     ])->where("company_id" , Auth::user()->company_id)->get();
        
        $customer_uids = CustomerUid::with([
                // 'customer' => function ($q) use ($startDate, $endDate) {
                //     $q->with([
                //         'collections' => function ($q2) use ($startDate, $endDate) {
                //             $q2->whereBetween('pickup_date', [$startDate, $endDate]);
                //         },
                //         'collections.collectionSkips'
                //     ])->where('company_id', Auth::user()->company_id);
                // }
                'customer',
                'collections' => function ($q2) use ($startDate, $endDate) {
                    $q2->whereBetween('pickup_date', [$startDate, $endDate]);
                },
                'collections.collectionSkips'
            ])
            ->whereHas('customer', function ($q) {
                $q->where('company_id', Auth::user()->company_id);
            });
        if(!is_null($request->input("customers"))){
            $customer_uids = $customer_uids->whereIn("id",$request->input("customers"));
        }   
            
        $customer_uids = $customer_uids->get();
                    
        
        // echo "<pre>";
        // print_r($customer_uids);
        // die();
        
        $company = Company::find(Auth::user()->company_id);
        
        return view('billing.bill_fetch',compact("customer_uids","company"));
    }
    public function generate(Request $request){
        $this->validate($request, [
            'municipality_fee' => 'min:0',
        ]);
        
        $input = $request->all();
        $datetime = Carbon::now('Asia/Dubai');
        
        try{
            $company_detail = Company::find(Auth::user()->company_id);
            $invoice_number = 1;
            $inc_val = 1;
            if(!is_null($company_detail->invoice_number_format)){
                $inc_val = is_null($company_detail->invoice_last_increment_number) ? 1 : ($company_detail->invoice_last_increment_number + 1);
                $now = now();
                $invoice_number = str_replace(
                    ['{i}', '{d}', '{m}', '{y}'],
                    [$inc_val, $now->day, $now->month, $now->year],
                    $company_detail->invoice_number_format
                );
            }elseif(!is_null($company_detail->invoice_last_increment_number)){
                $invoice_number = ($company_detail->invoice_last_increment_number + 1);
                $inc_val = ($company_detail->invoice_last_increment_number + 1);
            }
            
            
            
            $billing_array = [
                'customer_id' => $input['customer_id'],
                'customer_uid_id' => $input['customer_uid_id'],
                 'company_id' => Auth::user()->company_id,
                 'invoice_number' => $invoice_number,
                 'date_from' => date("Y-m-d",strtotime($input['pickup_date'][0])),
                 'date_to' =>  date("Y-m-d",strtotime($input['pickup_date'][count($input['pickup_date']) - 1])),
                 'generated_by' => Auth::user()->id,
                 'generated_date' => $datetime->format('Y-m-d H:i:s'),
                //  'municipality_fee' => $input['municipality_fee'],
                 'gate_fee' => !is_null($input['gate_fee']) ? $input['gate_fee'] : 0,
                 'extra_charges' => !is_null($input['extra_charges']) ? $input['extra_charges'] : 0,
                 'discount' => !is_null($input['discount']) ? $input['discount'] : 0,
                 'note' => $input['note']
            ];
            $billing = Billing::create($billing_array);
            $billing_id = $billing->id;
            
            foreach($input['municipality_skip_size'] as $key => $val){
                BillingMunicipality::create([
                    'billing_id' => $billing_id,
                     'skip_size' => $val,
                     'waste_type' => $input['municipality_waste_type'][$key],
                     'quantity' => $input['municipality_quantity'][$key],
                     'price' => $input['municipality_skip_price'][$key]    
                ]);
            }
            
            foreach($input['driver'] as $key => $val){
                $bill_detail = [
                    'billing_id' => $billing_id,
                     'collection_id' => $input['collection_id'][$key],
                     'driver_id' => $val,
                     'helper_ids' => $input['helpers'][$key],
                     'total_price' => $input['total_price'][$key],
                    //  'extra_charges' => !is_null($input['extra_charges'][$key]) ? $input['extra_charges'][$key] : 0,
                ];
                
                $billing_detail = BillingDetail::insertGetId($bill_detail);
                $billing_detail_id = $billing_detail;
                
                $detail_skip = [];
                foreach($input['skip_size'][$key] as $key2 => $val2){
                    $dt_skip = [
                    'billing_detail_id' => $billing_detail_id,
                        'skip_size' => $val2,
                         'waste_type' => $input['waste_type'][$key][$key2],
                         'skip_price' => $input['skip_price'][$key][$key2],
                         'quantity' => $input['skip_quantity'][$key][$key2],
                    ];
                    
                    array_push($detail_skip,$dt_skip);
                }
                BillingDetailSkip::insert($detail_skip);
            }
            
            Company::where("id",Auth::user()->company_id)->update(["invoice_last_increment_number" => $inc_val]);
            return json_encode(["status" => true]);
        }catch(Exception $ex){
            return json_encode(["status" => false, "message" => $ex]);
        }
    }
    
    public function invoice_generate($billing_id,$view_invoice){
        $datetime = Carbon::now('Asia/Dubai');
        $bills = Billing::with([
            'customer_uid',
            'customer_uid.customer',
        ])->find($billing_id);
        
        if(!$view_invoice){
            Billing::where("id",$billing_id)->update([
                "invoice_generated" => 1,
                "invoice_generated_by" => Auth::user()->id,
                "invoice_generated_date" => $datetime->format('Y-m-d H:i:s'),
            ]);
        }
        
        $billing_record = $this->fetch_billing_record($billing_id);
        
        $billing = $billing_record->billing;
        $company = $billing_record->company;
        
        
        $billing->skips = BillingDetailSkip::select(["billing_detail_skips.waste_type", "billing_detail_skips.skip_size", DB::raw("Max(billing_detail_skips.skip_price) as price"), DB::raw("SUM(billing_detail_skips.quantity) as quantity"),DB::raw("'true' as skip_collection")])
        ->join("billing_details","billing_details.id","=","billing_detail_skips.billing_detail_id")
        ->where("billing_details.billing_id",$billing_id)
        ->groupBy(["billing_detail_skips.waste_type","billing_detail_skips.skip_size"])
        ->get();
        
        
        // $merged = $billing->skips->toArray()->merge($billing->billing_municipality->toArray());
        $merged = $billing->skips->concat($billing->billing_municipality)->values();
        
        $sorted = $merged->sort(function ($a, $b) {
            // Eloquent models → use property access
            $sizeA = (float) filter_var($a->skip_size, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $sizeB = (float) filter_var($b->skip_size, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        
            if ($sizeA === $sizeB) {
                // If same skip size, sort by waste_type
                return $a->waste_type <=> $b->waste_type;
            }
        
            return $sizeA <=> $sizeB;   // ascending by size
        })->values(); 
        
        
        $billing->merge_collections = $sorted;
        // echo "<pre>";
        // print_r($billing->skips);
        // echo "<pre>";
        // print_r($sorted);
        // die();
    
    
        
        // PDF Coding
        $pdf = PDF::loadView('billing.print_view', [
            'billing' => $billing,
            'company' => $company,
            'isPdf'   => true,
        ])
        ->setOption('print-media-type', true);
        
        $fileName = str_replace("/","~","{$bills->invoice_number} - {$bills->customer_uid->skip_location} - {$bills->customer_uid->customer->company_name}.pdf");
        $fullPath = public_path('pdf/' . $fileName);
        // delete old file if it exists
        if (file_exists($fullPath)) {
            unlink($fullPath);      // ðŸ‘ˆ this removes the old PDF
        }
        
        $pdf->save($fullPath);
        
        return (Object)[
            'billing' => $billing,
            'company' => $company,
            "file_path" => $fileName
        ];
    }
    
    public function generate_invoice_print($billing_id , $view_invoice){
        
        $rt = $this->invoice_generate($billing_id,$view_invoice);
        
        
        return view('billing.print_view',[
            'billing' => $rt->billing,
            'company' => $rt->company,
            'isPdf'   => false,
        ]);
    }
    
    public function generate_bulk_invoice_print(Request $request){
        
        // $billing_ids = [1,2];
        $billing_ids = $request->input('bill_ids', []);
        
        $files = [];
        foreach($billing_ids as $billing_id){
            $rt = $this->invoice_generate($billing_id,false);
            array_push($files,env('APP_URL').asset("/pdf/".$rt->file_path));
        }
        
        $zipDir = public_path('zip');
        if (!file_exists($zipDir)) {
            mkdir($zipDir, 0755, true);
        }
        
        $zipFileName = 'download_' . now()->format('Ymd_His') . '.zip';
        $zipPath = $zipDir . '/' . $zipFileName;
        
        
        $zip = new \ZipArchive();
        $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        
        foreach ($files as $url) {
            
            try {
                
                $response = Http::timeout(30)->get($url);

                if (! $response->successful()) {
                    // optional: log failed URL
                    \Log::warning("Failed to fetch {$url}, status: " . $response->status());
                    continue;
                }

                $fileContent = $response->body();

                // Get filename from URL
                $fileName = basename(parse_url($url, PHP_URL_PATH)) ?: ('file_' . Str::random(6));
                

                // Add file content to zip
                $zip->addFromString($fileName, $fileContent);
            } catch (\Exception $e) {
                \Log::warning("Failed to add {$url} to zip: " . $e->getMessage());
            }
        }
        
        $zip->close();
        
        // âœ… Check if ZIP exists before sending
        if (!file_exists($zipPath)) {
            \Log::error("ZIP not found after close(): {$zipPath}");
            return response()->json(['error' => 'ZIP file not created.'], 500);
        }
        
        // Download and delete after send
        return response()->download($zipPath, $zipFileName)->deleteFileAfterSend(true);
    }
    
    public function edit($billing_id){
        $billing_record = $this->fetch_billing_record($billing_id);
        
        $billing = $billing_record->billing;
        $company = $billing_record->company;
        
        return view('billing.edit',compact("billing","company"));
    }
    
    public function update(Request $request , $billing_id){
        $this->validate($request, [
            'gate_fee' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'extra_charges' => 'nullable|numeric|min:0'
        ]);
        
        
        $input = $request->all();
        
        Billing::where("id",$billing_id)->update([
            // "municipality_fee"=> $input['municipality_fee'],
            "gate_fee"=> !is_null($input['gate_fee']) ? $input['gate_fee'] : 0,
            "discount"=> !is_null($input['discount']) ? $input['discount'] : 0,
            "extra_charges"=> !is_null($input['extra_charges']) ? $input['extra_charges'] : 0,
            "note"=> $input['remarks'],
            "invoice_generated" => 0,
            "invoice_generated_by" => 0,
            "invoice_generated_date" => null,
        ]);
        BillingMunicipality::where("billing_id",$billing_id)->delete();
        foreach($input['municipality_skip_size'] as $key => $val){
            BillingMunicipality::create([
                'billing_id' => $billing_id,
                 'skip_size' => $val,
                 'waste_type' => $input['municipality_waste_type'][$key],
                 'quantity' => $input['municipality_quantity'][$key],
                 'price' => $input['municipality_skip_price'][$key]    
            ]);
        }
        
        return redirect()->route('billings.edit',$billing_id)
                        ->with('success','Company deleted successfully');
    }
    
    public function invoice_paid($billing_id){
        $datetime = Carbon::now('Asia/Dubai');
        Billing::where("id",$billing_id)->update([
            "is_paid"=>1,
            "paid_date" => $datetime->format('Y-m-d H:i:s')
        ]);
        return redirect()->route('billings.index')
                        ->with('success','Company deleted successfully');
    }
    // public function generate($date){
    //     $date = explode(" to ",$date);
    //     $startDate = $date[0];
    //     $endDate = $date[1];
        
    //     // $customers = (new CustomerController)->getCustomers();
        
    //     // foreach($customers as $key => $val){
    //     //     $customers[$key]->collection = Collection::where("customer_id",$val->id)->whereBetween('pickup_date', [$startDate, $endDate])
    //     //             ->get();
    //     //     foreach($customers[$key]->collection as $key2 => $val2){
    //     //         $customers[$key]->collection[$key2]->collection_skip = CollectionSkip::where("collection_id",$val2->id)->get();
    //     //     }
    //     // }
        
    //     $customers = Customer::with([
    //             'collections' => function ($q) use ($startDate, $endDate) {
    //                 $q->whereBetween('pickup_date', [$startDate, $endDate]);
    //             },
    //             'collections.collectionSkips'
    //         ])->where("company_id" , Auth::user()->company_id)->get();
        
                    
        
    //     // echo "<pre>";
    //     // print_r($customers);
    //     // die();
        
    //     return view('billing.bill_view',compact("customers"));
    // }
}