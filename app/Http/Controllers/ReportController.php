<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Hash;
use Auth;
use Carbon\Carbon;
use DB;

use App\Http\Controllers\CustomerController;

use App\Models\User;
use App\Models\Vehicle;


use App\Models\Collection;
use App\Models\DumpHistory;


class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->middleware('permission:reporting', ['only' => ['index','view']]);
    }
    public function index()
    {
        $company_id = Auth::user()->company_id;
        $drivers = User::whereHas('roles', function ($query) {
                    $query->where('name', 'Driver');
                })
                ->where('company_id', $company_id)
                ->where('is_deleted', 0)
                ->get();
                
        $vehicles = Vehicle::where('company_id', $company_id)
                ->where('is_deleted', 0)
                ->get();
                
                
        
        
        
        
                
        return view('reporting.index',compact("drivers","vehicles"));
    }
    
    public function fetch(Request $request){
        
        $company_id = Auth::user()->company_id;
        
        $selected_date = $request->input("range");
        
        $startDate = "";
        $endDate = "";
        if(!empty($request->input("range"))){
            $date = explode(" to ",$request->input("range"));
            $startDate = $date[0];
            
            if(isset($date[1])){
                $endDate = date('Y-m-d H:i:s', strtotime($date[1] . ' +1 day'));
            }else{
                $endDate = date('Y-m-d H:i:s', strtotime($date[0] . ' +1 day'));
            }
        }
        
        $collections = Collection::select(["collections.pickup_date","collections.helper_ids","users.name","customers.company_name","customers.client_id","customer_uids.skip_location"])
        ->leftJoin("users","users.id","=","collections.driver_id")
        ->leftJoin("customers","customers.id","=","collections.customer_id")
        ->leftJoin("customer_uids","customer_uids.id","=","collections.customer_uid_id");
        if(!is_null($request->input("drivers"))){
            $collections = $collections->whereIn("collections.driver_id",$request->input("drivers"));
        }
        if(!is_null($request->input("vehicles"))){
            $collections = $collections->whereIn("collections.vehicle_id",$request->input("vehicles"));
        }
        if(!empty($startDate)){
            $collections = $collections->whereBetween('pickup_date', [$startDate, $endDate]);
        }
        $collections = $collections->where("collections.company_id",$company_id)->whereNotNull("pickup_date")->orderBy("pickup_date","DESC")->get();
        
        $collections->each(function ($detail) {
            if ($detail->helper_ids) {
                $ids = array_filter(explode(',', $detail->helper_ids)); // split CSV
                $detail->helpers = User::whereIn('id', $ids)->get()->pluck("name")->toArray();    // fetch helpers
            } else {
                $detail->helpers = collect(); // empty collection if no helpers
            }
        });
        
        $dump_total_count =  DumpHistory::where("company_id",$company_id);
        if(!is_null($request->input("drivers"))){
            $dump_total_count = $dump_total_count->whereIn("driver_id",$request->input("drivers"));
        }
        if(!is_null($request->input("vehicles"))){
            $dump_total_count = $dump_total_count->whereIn("vehicle_id",$request->input("vehicles"));
        }
        if(!empty($startDate)){
            $dump_total_count = $dump_total_count->whereBetween('dump_date', [$startDate, $endDate]);
        }
        $dump_total_count = $dump_total_count->count();
        
        $bar_cart_data = User::withCount([
                'collections_driver' => function ($q) use ($startDate, $endDate,$request) {
                    if(!empty($startDate)){
                        $q->whereBetween('pickup_date', [$startDate, $endDate]);
                    }
                    if(!is_null($request->input("vehicles"))){
                        $q->whereIn('vehicle_id', $request->input("vehicles"));
                    }
                }, 
                'dumps_driver' => function ($q) use ($startDate, $endDate,$request) {
                    if(!empty($startDate)){
                        $q->whereBetween('dump_date', [$startDate, $endDate]);
                    }
                    if(!is_null($request->input("vehicles"))){
                        $q->whereIn('vehicle_id', $request->input("vehicles"));
                    }
                }
                ])
                ->whereHas('roles', function ($query) {
                    $query->where('name', 'Driver');
                });
        if(!is_null($request->input("drivers"))){
            $bar_cart_data = $bar_cart_data->whereIn("id",$request->input("drivers"));
        }        
        $bar_cart_data = $bar_cart_data->where('company_id', $company_id)
                ->where('is_deleted', 0)
                ->get();
                
        $bar_cart = [
            'drivers'        => $bar_cart_data->pluck('name')->map(fn($n) => "\"{$n}\"")->implode(' , '),
            'collections' => $bar_cart_data->pluck('collections_driver_count')->implode(' , '),
            'dumps'       => $bar_cart_data->pluck('dumps_driver_count')->implode(' , '),
        ];
        
        // echo "<pre>";
        // print_r($bar_cart);
        // die();
        
        return view('reporting.report',compact("collections","dump_total_count","bar_cart","selected_date"));
    }
    
}