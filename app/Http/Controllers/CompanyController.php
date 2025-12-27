<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Hash;
use Auth;


use App\Models\Company;
use App\Models\CompanySkipSetting;


class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getCompanies(){
        $data = User::select(["users.*","companies.contact_person_name","companies.contact_person_number","companies.logo_guid"])
        ->where("is_company",1)
        ->join("companies","companies.id","=","users.company_id")
        ->orderBy('companies.id','DESC')->paginate(5);
        return $data;
    }
    public function getSingleCompanyDataByUserId($id){
        $company = User::select(["users.*","companies.id as company_id","companies.company_name","companies.company_address","companies.contact_person_name","companies.contact_person_number","companies.logo_guid"])
        ->join("companies","companies.id","=","users.company_id")
        ->where("users.company_id",$id)->first();
        
        return $company;
    }
    public function index(Request $request){
        $data = $this->getCompanies();
        return view('company.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function create()
    {
        return view('company.create');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required',
            'company_address' => 'required',
            'contact_person_name' => 'required',
            'contact_person_phone' => 'required|numeric',
            'contact_person_email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        
        if($request->hasfile('logo')) {
            $file = $request->file('logo');
            $name = $file->getClientOriginalName();
            
            $file->move($_SERVER['DOCUMENT_ROOT'].env('ASSET_URL').'/images/company_logo/', $name); 
            $profile_pic = "/images/company_logo/".$name;
            
            $company['logo_guid']=$profile_pic;
        }
        
        $company = [
            "company_name" => $input['company_name'],
            "company_address" => $input['company_address'],
            "contact_person_name" => $input['contact_person_name'],
            "contact_person_number" => $input['contact_person_phone'],
        ];
        $company = Company::create($company);
        
        $user = [
            "name"=>$input['company_name'],
            "email"=>$input['contact_person_email'],
            "password"=>$input['password'],
            "is_company"=> 1,
            "company_id"=> $company->id
        ];
        
        $user = User::create($user);
        $user->assignRole("Company");
    
        return redirect()->route('company.index')
                        ->with('success','Company created successfully');
    }
    
    public function show($id)
    {
        $company =  $this->getSingleCompanyDataByUserId($id);
        return view('company.show',compact('company'));
    }
    public function edit($id)
    {
        $company = $this->getSingleCompanyDataByUserId($id);
        return view('company.edit',compact('company'));
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'company_name' => 'required',
            'company_address' => 'required',
            'contact_person_name' => 'required',
            'contact_person_phone' => 'required|numeric',
            'contact_person_email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password'
        ]);
    
        $input = $request->all();
        
        $user = [
            "name"=>$input['company_name'],
            "email"=>$input['contact_person_email'],
            // "user_type" => $input['user_type']
        ];
        if(!empty($input['password'])){ 
            $user['password'] = Hash::make($input['password']);
        }
        
        $user = User::where("id",$id)->where("is_company",1)->update($user);
        // $user->assignRole("Company");
        
        $company_id = User::where("id",$id)->value("company_id");
        
        $company = [
            "company_name" => $input['company_name'],
            "company_address" => $input['company_address'],
            "contact_person_name" => $input['contact_person_name'],
            "contact_person_number" => $input['contact_person_phone']
        ];
        
        if($request->hasfile('logo')) {
            $file = $request->file('logo');
            $name = $file->getClientOriginalName();
            
            $file->move($_SERVER['DOCUMENT_ROOT'].env('ASSET_URL').'/images/company_logo/', $name); 
            $profile_pic = "/images/company_logo/".$name;
            
            $company['logo_guid']=$profile_pic;
        }
        $company = Company::where("id",$company_id)->update($company);
    
        return redirect()->route('company.index')
                        ->with('success','Company Updated successfully');
    }
    
    public function destroy($id)
    {
        User::where("company_id",$id)->where("is_company",1)->update([
            "is_deleted"=>1
        ]);
        return redirect()->route('company.index')
                        ->with('success','Company deleted successfully');
    }
    public function settings(){
        $company = Company::find(Auth::user()->company_id);
        
        $skip_settings = CompanySkipSetting::where(["company_id" => Auth::user()->company_id,"is_deleted" => 0])->get();
        
        return view('company.settings',compact('company','skip_settings'));
    }
    public function skip_setup(){
        $company = Company::find(Auth::user()->company_id);
        
        $skip_settings = CompanySkipSetting::where(["company_id" => Auth::user()->company_id,"is_deleted" => 0])->get();
        
        return view('company.skip_setup',compact('company','skip_settings'));
    }
    
    public function invoice_logo(Request $request, $id){
        $this->validate($request, [
            'contact_person' => 'required',
            'phone_no' => 'required|numeric'
        ]);
        
        $input = $request->all();
        
        
        $company = [
            'invoice_contact_person' => $input['contact_person'],
            'invoice_phone_no' => $input['phone_no'],
            'tax_registration_number' => $input['tax_registration_number'],
            'invoice_due_period' => !empty($input['invoice_due_period']) ? $input['invoice_due_period'] : 0,
            'terms_n_conditions' => $input['terms_n_conditions'],
            'invoice_number_format' => $input['invoice_number_format'],
            'invoice_last_increment_number' => $input['invoice_last_increment_number'],
            'time_format' => $input['time_format'],
        ];
        
        if($request->hasfile('logo')) {
            $file = $request->file('logo');
            $name = $file->getClientOriginalName();
            
            $file->move($_SERVER['DOCUMENT_ROOT'].env('ASSET_URL').'/images/company_logo/', $name); 
            $profile_pic = "/images/company_logo/".$name;
            
            $company['logo_guid']=$profile_pic;
        }
        
        if($request->hasfile('stamp_image')) {
            $file = $request->file('stamp_image');
            $name = $file->getClientOriginalName();
            
            $file->move($_SERVER['DOCUMENT_ROOT'].env('ASSET_URL').'/images/stamp_image/', $name); 
            $profile_pic = "/images/stamp_image/".$name;
            
            $company['stamp_image_guid']=$profile_pic;
        }
        
        Company::where("id",$id)->update($company);
    
        return redirect()->route('settings');
    }
    public function skip_setting_store(Request $request, $id){
        $this->validate($request, [
            'skip_size' => 'required',
            'skip_price' => 'required|numeric',
            'municipality_fee' => 'required|numeric'
        ]);
        $input = $request->all();
        $input['company_id'] = $id;
        CompanySkipSetting::create($input);
        
        return redirect()->route('settings');
    }
    
    public function skip_setting_update(Request $request, $id){
        $this->validate($request, [
            'skip_size' => 'required',
            'skip_price' => 'required|numeric',
            'municipality_fee' => 'required|numeric'
        ]);
        $input = $request->all();
        unset($input['_token']);
        CompanySkipSetting::where("id",$id)->update($input);
        
        return redirect()->route('settings');
    }
    public function delete_skip($id){
        
        CompanySkipSetting::where("id",$id)->update(['is_deleted' => 1]);
        
        return redirect()->route('settings');
    }
    
    
}
