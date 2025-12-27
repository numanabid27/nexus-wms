<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Auth;
use DB;
use Hash;
use Illuminate\Support\Arr;

    
class EmployeeController extends Controller
{
    
    public function __construct()
    {
         $this->middleware('permission:employee-list|employee-create|employee-edit|employee-delete', ['only' => ['index','store']]);
         $this->middleware('permission:employee-create', ['only' => ['create','store']]);
         $this->middleware('permission:employee-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:employee-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::where(["company_id"=>Auth::user()->company_id,"is_company" => 0])->orderBy('id','DESC')->paginate(5);
        return view('employee.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::whereNotIn('name', ['Super Admin', 'Company'])->pluck('name','name')->all();
        return view('employee.create',compact('roles'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['company_id'] = Auth::user()->company_id;
        
        if($request->hasfile('logo')) {
            $file = $request->file('logo');
            $name = date('Y-m-d H:i:s').$file->getClientOriginalName();
            
            $file->move($_SERVER['DOCUMENT_ROOT'].env('ASSET_URL').'/images/employees/', $name); 
            $profile_pic = "/images/employees/".$name;
            
            
            $input['image_name']=$name;
            $input['image_guid']=$profile_pic;
        }
        
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('employee.index')
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
        return view('employee.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::whereNotIn('name', ['Super Admin', 'Company'])->pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('employee.edit',compact('user','roles','userRole'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        if($request->hasfile('logo')) {
            $file = $request->file('logo');
            $name = date('Y-m-d H:i:s').$file->getClientOriginalName();
            
            $file->move($_SERVER['DOCUMENT_ROOT'].env('ASSET_URL').'/images/employees/', $name); 
            $profile_pic = "/images/employees/".$name;
            
            
            $input['image_name']=$name;
            $input['image_guid']=$profile_pic;
        }
        
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('employee.index')
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
        User::find($id)->update(["is_deleted"=>1]);
        return redirect()->route('employee.index')
                        ->with('success','User deleted successfully');
    }
    
    public function active($id)
    {
        User::where("id",$id)->update([
            "is_deleted"=>0
        ]);
        return redirect()->route('employee.index')
                        ->with('success','Company deleted successfully');
    }
    
    public function profile(){
        $user = Auth::user();
        $locations = 0; // count((new FacilityController)->getFacility());
        $employees = 0; // count((new EmployeeController)->getEmployees());
        return view('employee.profile',compact('user','locations','employees'));
    }
}