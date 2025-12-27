<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Asset;
use App\Models\Manufacturer;
use App\Models\AssetUid;
use App\Models\AssetDocument;
use App\Models\AssetCertificate;
use App\Models\AssetPreUsePoint;

use App\Models\PreUseInspection;
use App\Models\PreUseInspectionPoint;


use App\Models\MaintenanceInspection;
use App\Models\MaintenanceInspectionPoint;


use App\Models\Inspection;

use App\Models\AssetMaintenancePoint;


use App\Models\Facility;

use App\Models\PreUseTemplate;
use App\Models\PreUseTemplatePoint;


use App\Models\ThoroughExamination;
use App\Models\MultiCertificate;


class AssetController extends Controller
{
    public function getAssetCounts($id,$userType){
        
        $rt = [];
        $rt['count_1'] = 0;
        $rt['count_2'] = 0;
        $rt['count_3'] = 0;
        
        $inspection = Inspection::leftJoin("inspection_assets","inspection_assets.inspection_id","=","inspections.id")
            ->where("status","!=",3);
        if($userType == "company"){
            $inspection = $inspection->where("inspections.company_id",$id);
        }elseif($userType == "inspection_company"){
            $inspection = $inspection->where("inspections.inspection_company_id",$id);
        }else{
            $inspection = $inspection->where("inspection_assets.assigned_employee",$id);
        }
        $inspection = $inspection->count();
        
        $rt['count_1'] = $inspection;
        
        $inspection = Inspection::leftJoin("inspection_assets","inspection_assets.inspection_id","=","inspections.id")
        ->where("status",3);
        if($userType == "company"){
            $inspection = $inspection->where("inspections.company_id",$id);
        }elseif($userType == "inspection_company"){
            $inspection = $inspection->where("inspections.inspection_company_id",$id);
        }else{
            $inspection = $inspection->where("inspection_assets.assigned_employee",$id);
        }
        $inspection = $inspection->count();
        $rt['count_2'] = $inspection;
        
        
        $facility = Facility::select("facilities.*")
        ->leftJoin("facility_employees","facility_employees.facility_id","=","facilities.id")
        ->where("is_deleted", 0);
        if($userType == "company"){
            $facility = $facility->where("facilities.company_id",$id);
        }else{
            $facility = $facility->where("facility_employees.employee_id",$id);
        }
        $facility = $facility->groupBy("facilities.id")->get()->count();
        $rt['count_3'] = $facility;
        
        return $this->returnSuccess("Success",$rt);
    }
    public function getAssetsList($id,$userType){
        $assets = Asset::select(["assets.*",DB::raw("manufacturers.manufacturer_title as manufacturer")])
        ->join("manufacturers","manufacturers.id","=","assets.manufacturer_id")
        ->leftJoin("inspection_assets","inspection_assets.asset_id","=","assets.id")
        ->leftJoin("inspections","inspections.id","=","inspection_assets.inspection_id");
        
        if($userType == "company"){
            $assets = $assets->where("assets.company_id",$id);
        }elseif($userType == "inspection_company"){
            $assets = $assets->where("inspections.inspection_company_id",$id);
        }else{
            $assets = $assets->where("inspection_assets.assigned_employee",$id);
        }
        $assets = $assets->get()->toArray();
        
        return $this->returnSuccess("Success",$assets);
    }
    public function getAssetDetailByUid($uid,$asset_type){
        //  $asset = Asset::find($id);
        $asset = Asset::select(["assets.*"])
        // ->join("asset_uids","asset_uids.asset_id","=","assets.id")
        ->where("uid_no",$uid)
        ->where("asset_type",$asset_type)
        ->where("is_deleted",0)->first();
        if(!is_null($asset)){
            $id = $asset->id;
             $asset->uid = $uid;//AssetUid::where("asset_id",$id)->get();
            
            $asset->manufacturer = Manufacturer::find($asset->manufacturer_id);
            
             $asset->documents = AssetDocument::where("asset_id",$id)->where("is_deleted",0)->get();
             $asset->certificates = AssetCertificate::where("asset_id",$id)->where("is_deleted",0)->get();
             $asset->pre_use = AssetPreUsePoint::where("asset_id",$id)->get();
             $asset->maintenance_points = AssetMaintenancePoint::where("asset_id",$id)->get();
             
            //  $asset->thorough_examinations = ThoroughExamination::where("asset_id",$id)->get();
            //  $asset->multi_certificates = MultiCertificate::where("asset_id",$id)->get();
             
             
             
             return $this->returnSuccess("Success",$asset);
        }else{
            return $this->returnError("No Tag Found!");
        }
        
    }
    
    public function savePreUseInspection(Request $request){
        $input = $request->all();
        
        $tag_id = Asset::select("id")->where("uid_no",$input['tag_id'])->first();
        $pre_use_points = AssetPreUsePoint::where("asset_id",$input['asset_id'])->get();
        
        $inspection = [
            "user_id"=>$input['user_id'],
            "asset_id"=>$input['asset_id'],
            "tag_id"=>$tag_id->id,
            'note' => $input['note']
        ];
        
        if($request->hasFile('signature')){
            $file = $request->file('signature');
            $name = $file->getClientOriginalName();
            $file->move($_SERVER['DOCUMENT_ROOT'].env('DOCUMENT_UPLOAD_URL').'public/asset/inspection_officer_signature/', $name); 
            $quote = "/asset/inspection_officer_signature/".$name;
            
            $inspection['signature_guid'] = $quote;
        }
        if($request->hasFile('image')){
            $file = $request->file('image');
            $name = $input['tag_id']." ".date('Y-m-d H:i:s')."-".$file->getClientOriginalName();
            $file->move($_SERVER['DOCUMENT_ROOT'].env('DOCUMENT_UPLOAD_URL').'public/asset/inspection_image/', $name); 
            $quote = "/asset/inspection_image/".$name;
            
            $inspection['image_guid'] = $quote;
        }
        
        $inspectionSave = PreUseInspection::create($inspection);
        array_pop($input['steps']);
        $inspection_point = [];
        foreach($pre_use_points as $key => $val){
            PreUseInspectionPoint::create([
                "inspection_id" => $inspectionSave->id,
                "point"=>$val->point_text,
                "status" => $input['steps'][$key],
            ]);
        }
        
        return $this->returnSuccess("Success",[]);
    }
    
    public function saveMaintenanceInspection(Request $request){
        $input = $request->all();
        
        $tag_id = Asset::select("id")->where("uid_no",$input['tag_id'])->first();
        $maintenance_points = AssetMaintenancePoint::where("asset_id",$input['asset_id'])->get();
        
        $inspection = [
            "user_id"=>$input['user_id'],
            "asset_id"=>$input['asset_id'],
            "tag_id"=>$tag_id->id,
            'note' => $input['note']
        ];
        
        if($request->hasFile('signature')){
            $file = $request->file('signature');
            $name = $file->getClientOriginalName();
            $file->move($_SERVER['DOCUMENT_ROOT'].env('DOCUMENT_UPLOAD_URL').'public/asset/inspection_officer_signature/', $name); 
            $quote = "/asset/inspection_officer_signature/".$name;
            
            $inspection['signature_guid'] = $quote;
        }
        if($request->hasFile('image')){
            $file = $request->file('image');
            $name = $input['tag_id']." ".date('Y-m-d H:i:s')."-".$file->getClientOriginalName();
            $file->move($_SERVER['DOCUMENT_ROOT'].env('DOCUMENT_UPLOAD_URL').'public/asset/inspection_image/', $name); 
            $quote = "/asset/inspection_image/".$name;
            
            $inspection['image_guid'] = $quote;
        }
        
        $inspectionSave = MaintenanceInspection::create($inspection);
        array_pop($input['steps']);
        $inspection_point = [];
        foreach($maintenance_points as $key => $val){
            MaintenanceInspectionPoint::create([
                "maintenance_inspection_id" => $inspectionSave->id,
                "point"=>$val->point_text,
                "status_value" => $input['steps'][$key],
                "cycle" => $val->cycle,
                "type" => $val->type,
                "min" => $val->min,
                "max" => $val->max
            ]);
        }
        
        return $this->returnSuccess("Success",[]);
    }
}
