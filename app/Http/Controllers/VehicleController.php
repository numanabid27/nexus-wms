<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Hash;
use Illuminate\Support\Arr;


use App\Models\User;
use App\Models\Vehicle;

    
class VehicleController extends Controller
{
    
    public function __construct()
    {
         $this->middleware('permission:vehicle-list|vehicle-create|vehicle-edit|vehicle-delete', ['only' => ['index','store']]);
         $this->middleware('permission:vehicle-create', ['only' => ['create','store']]);
         $this->middleware('permission:vehicle-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:vehicle-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Vehicle::select(["vehicles.*","users.name"])
        ->leftJoin("users","users.id","=","vehicles.driver_id")
        ->where(["vehicles.company_id"=>Auth::user()->company_id])
        ->orderBy('id','DESC')->paginate(5);
        return view('vehicles.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $drivers = User::role('driver')
            ->where(['is_deleted' => 0,"company_id"=>Auth::user()->company_id])
            ->get();
        return view('vehicles.create',compact('drivers'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'driver_id' => 'required',
            'plate_no' => 'required',
            'vehicle_type' => 'required',
            'contract_type' => 'required'
        ]);
    
        $input = $request->all();
        $input['company_id'] = Auth::user()->company_id;
        
        
        $user = Vehicle::create($input);
    
        return redirect()->route('vehicles.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('vehicles.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicle = Vehicle::find($id);
        $drivers = User::role('driver')
            ->where(['is_deleted' => 0,"company_id"=>Auth::user()->company_id])
            ->get();
    
        return view('vehicles.edit',compact('vehicle','drivers'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'driver_id' => 'required',
            'plate_no' => 'required',
            'vehicle_type' => 'required',
            'contract_type' => 'required'
        ]);
    
        $input = $request->all();
        
        $vehicle = Vehicle::find($id);
        
        
        $vehicle->update($input);
    
        return redirect()->route('vehicles.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vehicle::find($id)->update(["is_deleted"=>1]);
        return redirect()->route('vehicles.index')
                        ->with('success','User deleted successfully');
    }
    
    public function active($id)
    {
        Vehicle::where("id",$id)->update([
            "is_deleted"=>0
        ]);
        return redirect()->route('vehicles.index')
                        ->with('success','Company deleted successfully');
    }
    
}