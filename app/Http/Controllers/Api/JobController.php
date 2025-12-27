<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


use App\Models\User;
use App\Models\Vehicle;
use App\Models\JobHistory;
use App\Models\Customer;
use App\Models\CustomerSkip;


use App\Models\Collection;
use App\Models\CollectionSkip;

use App\Models\DumpHistory;

class JobController extends Controller
{
    public function getDetailByUID($uid,$asset_type){
        // $customer = Customer::with(["customer_uid","customer_uid.customer_skip"])->where("is_deleted",0)->whereRelation('customer_uid', 'tag_uid', $uid)->first();
        $customer = Customer::with(['customer_uid' => function ($q) use ($uid) {
            $q->where('tag_uid', $uid)->where("is_deleted" , 0)->with(['customer_skip' => function ($qs) {
              $qs->selectRaw('customer_skips.*, 0 as quantity');
          }]);
        }])
        ->where("is_deleted",0)
        // ->whereRelation('customer_uid', 'tag_uid', $uid)
        ->whereRelation('customer_uid', function ($q) use ($uid) {
            $q->where('tag_uid', $uid)
              ->where('is_deleted', 0); // ✅ added
        })
        ->first();
        if(!is_null($customer)){
            $id = $customer->id;
            $uid = $customer->customer_uid[0]->id;
            
            // $customer->skip_detail = CustomerSkip::select(["id","skip_size","skip_price",DB::raw("0 as quantity")])->where("customer_id",$id)->get();
            
            $customer_last_collection = Collection::where(["customer_id" => $id,"customer_uid_id" => $uid])->orderBy("id","DESC")->first();
            if($customer_last_collection && is_null($customer_last_collection->pickup_date)){
                $customer->last_uncomplete_collection = $customer_last_collection;
                $customer->last_uncomplete_collection->skip_detail = CollectionSkip::select(["id","waste_type","skip_size","skip_price","quantity","municipality_fee"])->where("collection_id",$customer_last_collection->id)->get();
                
            }else{
               $customer->last_uncomplete_collection = null; 
            }
             
            return $this->returnSuccess("Success",$customer);
        }else{
            return $this->returnError("No Tag Found!");
        }
        
    }
    
    
    public function saveCollectionStep1(Request $request){
        $input = $request->all();
        
        try{
             $helper_id = $input['helper_id'];
            
            
            $check_job = JobHistory::whereNull("job_end_time")
            ->where(function($query)use($helper_id){
                $query->where("driver_id",$helper_id);
                $query->orWhereRaw("FIND_IN_SET(?, helper_ids)",$helper_id);
            })->orderBy("id","DESC")->first();
            
            
            $inspection = [
                'company_id' => $input['company_id'],
                'customer_id' => $input['customer_id'],
                'customer_uid_id' => $input['customer_uid_id'],
                'driver_id' => $check_job['driver_id'],
                'vehicle_id' => $check_job['vehicle_id'],
                'helper_ids' => $check_job['helper_ids'],
                
            ];
            
            if($request->hasFile('image')){
                $file = $request->file('image');
                $name = date('Y-m-d H:i:s')."-".$file->getClientOriginalName();
                $file->move($_SERVER['DOCUMENT_ROOT'].env('ASSET_URL').'/images/collection_before_pick/', $name); 
                $quote = "/images/collection_before_pick/".$name;
                
                $inspection['before_image_guid'] = $quote;
            }
            
            $collection_id = $input['collection_id'];
            if($collection_id > 0){
                $collection = Collection::where("id",$collection_id)->update($inspection); 
            }else{
                $collection = Collection::create($inspection); 
                $collection_id = $collection->id;
            }
            
            
            
            
            CollectionSkip::where("collection_id",$collection_id)->delete();
            $collection_steps = [];
            foreach($input['skip_detail'] as $key => $val){
                array_push($collection_steps,[
                    "collection_id" => $collection_id,
                    "waste_type" => $val['waste_type'],
                    "skip_size" => $val['skip_size'],
                    "skip_price" => $val['skip_price'],
                    "quantity" => $val['quantity'],
                    "municipality_fee" => $val['municipality_fee']   
                ]);
            }
            CollectionSkip::insert($collection_steps);
            
            return $this->returnSuccess("Success",["collection_id" => (int)$collection_id]);
        }catch(Exception $ex){
            return $this->returnError("Something went wrong!");
        }
    }
    
    public function saveCollectionStep2(Request $request){
        $input = $request->all();
        
        try{
             $collection_id = $input['collection_id'];
            
            $inspection = [
                'status' => $input['status']
                
            ];
            
            if($request->hasFile('image')){
                $file = $request->file('image');
                $name = date('Y-m-d H:i:s')."-".$file->getClientOriginalName();
                $file->move($_SERVER['DOCUMENT_ROOT'].env('ASSET_URL').'/images/collection_after_pick/', $name); 
                $quote = "/images/collection_after_pick/".$name;
                
                $inspection['after_image_guid'] = $quote;
            }
            
            
            $collection = Collection::where("id",$collection_id)->update($inspection); 
            
            
            return $this->returnSuccess("Success",[]);
        }catch(Exception $ex){
            return $this->returnError("Something went wrong!");
        }
    }
    
    public function saveCollectionStep3(Request $request){
        $input = $request->all();
        
        try{
             $collection_id = $input['collection_id'];
            
            $inspection = [
                'time_wasted' => $input['time_wasted'],
                "pickup_date" => $input['pickup_date'],
                'signatory_name' => $input['signatory']
            ];
            
            if($request->hasFile('signature')){
                $file = $request->file('signature');
                $name = date('Y-m-d H:i:s')."-".$file->getClientOriginalName();
                $file->move($_SERVER['DOCUMENT_ROOT'].env('ASSET_URL').'/images/customer_signature/', $name); 
                $quote = "/images/customer_signature/".$name;
                
                $inspection['signature_guid'] = $quote;
            }
            
            
            $collection = Collection::where("id",$collection_id)->update($inspection); 
            
            
            return $this->returnSuccess("Success",[]);
        }catch(Exception $ex){
            return $this->returnError("Something went wrong!");
        }
    }
    
    
    public function dumpTrash(Request $request){
        $input = $request->all();
        try{
            $helper_id = $input['helper_id'];
            $check_job = JobHistory::whereNull("job_end_time")
            ->where(function($query)use($helper_id){
                $query->where("driver_id",$helper_id);
                $query->orWhereRaw("FIND_IN_SET(?, helper_ids)",$helper_id);
            })->orderBy("id","DESC")->first();
            
            $dump = [
                'company_id' => $check_job['company_id'],
                'driver_id' => $check_job['driver_id'],
                'helper_ids' => $check_job['helper_ids'],
                'vehicle_id' => $check_job['vehicle_id'],
                'weight' => $input['weight'],
                'charges' => $input['charges'],
                'dump_date' => $input['dump_date']
                
            ];
            
            if($request->hasFile('image')){
                $file = $request->file('image');
                $name = date('Y-m-d H:i:s')."-".$file->getClientOriginalName();
                $file->move($_SERVER['DOCUMENT_ROOT'].env('ASSET_URL').'/images/trash_dump/', $name); 
                $quote = "/images/trash_dump/".$name;
                
                $dump['weight_meter_image_guid'] = $quote;
            }
            
            DumpHistory::create($dump);
            return $this->returnSuccess("Success",[]);
        }catch(Exception $ex){
            return $this->returnError("Something went wrong!");
        }
    }
}