<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Hash;
use Auth;


use App\Models\Customer;
use App\Models\CustomerUid;
use App\Models\CustomerSkip;
use App\Models\CompanySkipSetting;


class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getCustomers(){
        $data = Customer::with(["customer_uid","customer_uid.customer_skip"])->where("company_id" , Auth::user()->company_id)->get();
        
        
        return $data;
    }
    public function getSingleCustomerById($id, $show_deleted = true){
        $customer = Customer::with([
            "customer_uid" => function ($q) use ($show_deleted) {
                if(!$show_deleted){
                    $q->where('is_deleted', 0);
                }
            },
            "customer_uid.customer_skip"
            ])->find($id);
        
        // echo "<pre>";
        // print_r($customer);
        // die();
        // $customer->skips = CustomerSkip::where("customer_id",$id)->get();
        
        return $customer;
    }
    public function index(Request $request){
        $data = $this->getCustomers();
        return view('customer.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function create()
    {
        $skips = CompanySkipSetting::where(["company_id" => Auth::user()->company_id , "is_deleted" => 0])->get();
        return view('customer.create',compact("skips"));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required',
            'client_id' => 'required',
            'phone_no' => 'required',
            'email' => 'required|email',
            // 'tag_uid' => 'required',
            'address' => 'required',
            // 'skip_location' => 'required',
            'billing_model' => 'required',
            'schedule' => 'required',
            // 'waste_type' => 'required',
            // 'municipality_fee' => 'required|numeric',
            
            'tag_uid' => 'required|array|min:1',
            'tag_uid.0' => 'required|string',
            'tag_uid.*' => 'nullable|string',
            
            'skip_location' => 'required|array|min:1',
            'skip_location.0' => 'required|string',
            'skip_location.*' => 'nullable|string',
            
            
            
            'skip_size' => 'required|array|min:1',
            'skip_size.*.*' => 'required|string',
            'skip_size.*.*' => 'nullable|string',
            
            // 'skip_price' => 'required|array|min:1',
            // 'skip_price.0' => 'required|numeric',
            // 'skip_price.*' => 'nullable|numeric'
        ], [
            
            'tag_uid.required' => 'Please provide at least one Tag UID.',
            'tag_uid.array' => ' Tag UID must be a valid list.',
            'tag_uid.0.required' => 'At least one  Tag UID is required.', // ✅ custom message
            
            'skip_location.required' => 'Please provide at least one skip location.',
            'skip_location.array' => 'Skip location must be a valid list.',
            'skip_location.0.required' => 'At least one skip location is required.', // ✅ custom message
            
            // 'skip_size.required' => 'Please provide at least one skip size.',
            // 'skip_size.array' => 'Skip size must be a valid list.',
            // 'skip_size.0.required' => 'At least one skip size is required.', // ✅ custom message
            
            // 'skip_price.required' => 'Please provide at least one skip price.',
            // 'skip_price.array' => 'Skip price must be a valid list.',
            // 'skip_price.0.required' => 'At least one skip price is required.', // ✅ custom message
        ]);
    
        $input = $request->all();
        
        $customer_arr = [
            "company_id" => Auth::user()->company_id,
            "company_name" => $input['company_name'],
            'tax_registration_number' => $input['tax_registration_number'],
            "client_id" => $input['client_id'],
            "phone_no" => $input['phone_no'],
            "email" => $input['email'],
            "mobile_no" => $input['mobile_no'],
            // "tag_uid" => $input['tag_uid'],
            "address" => $input['address'],
            "po_number" => $input['po_number'],
            // "skip_location" => $input['skip_location'],
            "billing_model" => $input['billing_model'],
            "schedule" => $input['schedule'],
            // "waste_type" => $input['waste_type'],
            // "municipality_fee" => $input['municipality_fee'],
            'skip_provided' => $input['skip_provided'],
            'gate_fee' => !is_null($input['gate_fee']) ? $input['gate_fee'] : 0
        ];
        $customer = Customer::create($customer_arr);
        
        foreach($input['tag_uid'] as $key => $val){
            
            if(!empty($val) && !empty($input['skip_location'][$key])){
                $customer_skip_arr = [];
                $uid = CustomerUid::create([
                    "customer_id" => $customer->id,
                    "location_name" => $input['location_name'][$key],
                    "tag_uid" => $val,
                    "skip_location" => $input['skip_location'][$key]
                ]);
                
                foreach($input['skip_size'][$key] as $key2 => $val2){
                    if(!empty($val2) && !empty($input['skip_price'][$key][$key2])){
                        array_push($customer_skip_arr,[
                            "skip_size"=>$val2,
                            "skip_price"=>$input['skip_price'][$key][$key2],
                            "waste_type"=>$input['waste_type'][$key][$key2],
                            "municipality_fee"=>$input['municipality_fee'][$key][$key2],
                            "customer_uid_id"=> $uid->id
                        ]);
                    }
                }
                CustomerSkip::insert($customer_skip_arr);
            }
        }
    
        return redirect()->route('customer.index')
                        ->with('success','Company created successfully');
    }
    
    public function show($id)
    {
        $customer =  $this->getSingleCustomerById($id);
        return view('customer.show',compact('customer'));
    }
    public function edit($id)
    {
        $customer = $this->getSingleCustomerById($id,false);
        $skips = CompanySkipSetting::where(["company_id" => Auth::user()->company_id , "is_deleted" => 0])->get();
        return view('customer.edit',compact('customer','skips'));
    }
    
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'company_name' => 'required',
            'client_id' => 'required',
            'phone_no' => 'required',
            'email' => 'required|email',
            // 'tag_uid' => 'required',
            'address' => 'required',
            // 'skip_location' => 'required',
            'billing_model' => 'required',
            'schedule' => 'required',
            // 'waste_type' => 'required',
            // 'municipality_fee' => 'required|numeric',
            'tag_uid' => 'required|array|min:1',
            'tag_uid.0' => 'required|string',
            'tag_uid.*' => 'nullable|string',
            
            'skip_location' => 'required|array|min:1',
            'skip_location.0' => 'required|string',
            'skip_location.*' => 'nullable|string',
            
            
            
            'skip_size' => 'required|array|min:1',
            'skip_size.*.*' => 'required|string',
            'skip_size.*.*' => 'nullable|string',
        ], [
            'tag_uid.required' => 'Please provide at least one Tag UID.',
            'tag_uid.array' => ' Tag UID must be a valid list.',
            'tag_uid.0.required' => 'At least one  Tag UID is required.', // ✅ custom message
            
            'skip_location.required' => 'Please provide at least one skip location.',
            'skip_location.array' => 'Skip location must be a valid list.',
            'skip_location.0.required' => 'At least one skip location is required.', // ✅ custom message
        ]);
    
        $input = $request->all();
        
        $customer_arr = [
            "company_name" => $input['company_name'],
            'tax_registration_number' => $input['tax_registration_number'],
            "client_id" => $input['client_id'],
            "phone_no" => $input['phone_no'],
            "email" => $input['email'],
            "mobile_no" => $input['mobile_no'],
            // "tag_uid" => $input['tag_uid'],
            "address" => $input['address'],
            "po_number" => $input['po_number'],
            // "skip_location" => $input['skip_location'],
            "billing_model" => $input['billing_model'],
            "schedule" => $input['schedule'],
            // "waste_type" => $input['waste_type'],
            // "municipality_fee" => $input['municipality_fee'],
            'skip_provided' => $input['skip_provided'],
            'gate_fee' => !is_null($input['gate_fee']) ? $input['gate_fee'] : 0
        ];
        $customer = Customer::where("id",$id)->update($customer_arr);
        
        $uids = CustomerUid::where("customer_id",$id)->pluck("id");
        $uidsString = $uids->implode(',');
        
        // echo "<pre>";
        // print_r($input['location_name']);
        // die();
        
        // Tag difference code ------------------
        $oldTags = CustomerUid::where("customer_id",$id)
            ->pluck('tag_uid')
            ->toArray();
        $newTags = $input['tag_uid'];
        
        // Find removed & added tags
        $tagsToDelete = array_diff($oldTags, $newTags);
        $tagsToInsert = array_diff($newTags, $oldTags);
        $tagsUnchanged = array_intersect($oldTags, $newTags); // [123]
        
        // echo "<pre>";
        // print_r($input['skip_size'][0]);
        // echo "<pre>";
        // print_r($input['skip_size'][1]);
        // die();
        
        
        // Delete removed tags (456)
        CustomerUid::where("customer_id",$id)
            ->whereIn('tag_uid', $tagsToDelete)
            ->update(["is_deleted" => 1]);
        
        CustomerSkip::whereIn('customer_uid_id', $uids)->delete();
        // Insert new tags (789)
        foreach ($tagsToInsert as $key => $val) {
            if(!empty($val) && !empty($input['skip_location'][$key])){
                $customer_skip_arr = [];
                $uid = CustomerUid::create([
                    "customer_id" => $id,
                    "location_name" => $input['location_name'][$key],
                    "tag_uid" => $val,
                    "skip_location" => $input['skip_location'][$key]
                ]);
                
                foreach($input['skip_size'][$key] as $key2 => $val2){
                    if(!empty($val2) && !empty($input['skip_price'][$key][$key2])){
                        array_push($customer_skip_arr,[
                            "skip_size"=>$val2,
                            "skip_price"=>$input['skip_price'][$key][$key2],
                            "waste_type"=>$input['waste_type'][$key][$key2],
                            "municipality_fee"=>$input['municipality_fee'][$key][$key2],
                            "customer_uid_id"=> $uid->id
                        ]);
                    }
                }
                CustomerSkip::insert($customer_skip_arr);
            }
        }
        
        // update unchanged tags
        foreach ($tagsUnchanged as $key => $val) {
            if(!empty($val) && !empty($input['skip_location'][$key])){
                $customer_skip_arr = [];
                $uid = CustomerUid::updateOrCreate(
                        ['tag_uid' => $val,"customer_id" => $id],
                        [
                            'location_name' => $input['location_name'][$key],
                            'skip_location' => $input['skip_location'][$key],
                        ]
                    );
                foreach($input['skip_size'][$key] as $key2 => $val2){
                    
                    if(!empty($val2) && !empty($input['skip_price'][$key][$key2])){
                        array_push($customer_skip_arr,[
                            "skip_size"=>$val2,
                            "skip_price"=>$input['skip_price'][$key][$key2],
                            "waste_type"=>$input['waste_type'][$key][$key2],
                            "municipality_fee"=>$input['municipality_fee'][$key][$key2],
                            "customer_uid_id"=> $uid->id
                        ]);
                    }
                }
                CustomerSkip::insert($customer_skip_arr);
            }
        }
        
        // // --------------------------------------------------
        
        // CustomerUid::where("customer_id",$id)->delete();
        // CustomerSkip::whereIn('customer_uid_id', $uids)->delete();
        
        // foreach($input['tag_uid'] as $key => $val){
            
        //     if(!empty($val) && !empty($input['skip_location'][$key])){
        //         $customer_skip_arr = [];
        //         $uid = CustomerUid::create([
        //             "customer_id" => $id,
        //             "tag_uid" => $val,
        //             "skip_location" => $input['skip_location'][$key]
        //         ]);
                
        //         foreach($input['skip_size'][$key] as $key2 => $val2){
        //             if(!empty($val2) && !empty($input['skip_price'][$key][$key2])){
        //                 array_push($customer_skip_arr,[
        //                     "skip_size"=>$val2,
        //                     "skip_price"=>$input['skip_price'][$key][$key2],
        //                     "waste_type"=>$input['waste_type'][$key][$key2],
        //                     "municipality_fee"=>$input['municipality_fee'][$key][$key2],
        //                     "customer_uid_id"=> $uid->id
        //                 ]);
        //             }
        //         }
        //         CustomerSkip::insert($customer_skip_arr);
        //     }
        // }
    
        return redirect()->route('customer.index')
                        ->with('success','Company created successfully');
    }
    public function destroy($id)
    {
        Customer::where("id",$id)->update([
            "is_deleted"=>1
        ]);
        return redirect()->route('customer.index')
                        ->with('success','Company deleted successfully');
    }
    public function active($id)
    {
        Customer::where("id",$id)->update([
            "is_deleted"=>0
        ]);
        return redirect()->route('customer.index')
                        ->with('success','Company deleted successfully');
    }
}