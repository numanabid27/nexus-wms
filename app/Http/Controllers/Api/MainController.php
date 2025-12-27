<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


use App\Models\User;
use App\Models\Vehicle;
use App\Models\JobHistory;

class MainController extends Controller
{
    public function getHelpersDrivers($company_id){
        $helpers = User::whereHas('roles', function ($query) {
                    $query->where('name', 'Helper');
                })
                ->where('company_id', $company_id)
                ->where('is_deleted', 0)
                ->get();
                
        $drivers = User::whereHas('roles', function ($query) {
                    $query->where('name', 'Driver');
                })
                ->where('company_id', $company_id)
                ->where('is_deleted', 0)
                ->get();
                
        $vehicles = Vehicle::where('company_id', $company_id)
                ->where('is_deleted', 0)
                ->get();
                
        return $this->returnSuccess("Success",["helpers" => $helpers,"drivers" => $drivers,"vehicles" => $vehicles]);
    }
    public function checkActiveJob($employee_id){
        $check_job = JobHistory::select(["id","job_start_time"])
        ->whereNull("job_end_time")
        ->where(function($query)use($employee_id){
            $query->where("driver_id",$employee_id);
            $query->orWhereRaw("FIND_IN_SET(?, helper_ids)",$employee_id);
        })->first();
        
        if($check_job){
            return $this->returnSuccess("Success",["job_status" => true,"job_id" => $check_job->id,"start_time" => $check_job->job_start_time]);
        }else{
            return $this->returnSuccess("Success",["job_status" => false,"job_id" =>  0 ,"start_time" =>""]);
        }
        
    }
    public function jobStart(Request $request){
        $input = $request->all();
        
        try{
            $data = [
                "company_id" => $input['company_id'],
                "driver_id" => $input['driver_id'],
                "vehicle_id" => $input['vehicle_id'],
                "helper_ids" => $input['helper_ids'],
                "job_start_by" => $input['job_start_by'],
                "job_start_time" => $input['start_time']
            ];
            
            JobHistory::create($data);
            return $this->returnSuccess("Success",[]);
        }catch(Exception $ex){
            return $this->returnError("Something went wrong!");
        }
    }
    public function jobEnd(Request $request){
        $input = $request->all();
        
        try{
            $data = [
                "job_end_by" => $input['job_end_by'],
                "job_end_time" => $input['end_time']
            ];
            
            JobHistory::where("id",$input['job_id'])->update($data);
            return $this->returnSuccess("Success",[]);
        }catch(Exception $ex){
            return $this->returnError("Something went wrong!");
        }
    }
}