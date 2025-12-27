<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ReportController;
  
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
  
Route::get('/', function () {
    // return view('welcome');
    return view('auth.login');
});
  
Auth::routes();
  
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::get('profile', [UserController::class,'profile'])->name('profile');
    
    Route::resource('company', CompanyController::class);
    
    Route::get('settings', [CompanyController::class,'settings'])->name('settings');
    Route::get('skip_setup', [CompanyController::class,'skip_setup'])->name('skip_setup');
    Route::post('company/invoice_logo/{company_id}', [CompanyController::class,'invoice_logo'])->name('company.invoice_logo');
    Route::post('company/skip_setting_store/{company_id}', [CompanyController::class,'skip_setting_store'])->name('company.skip_setting_store');
    Route::post('company/skip_setting_update/{id}', [CompanyController::class,'skip_setting_update'])->name('company.skip_setting_update');
    Route::get('company/delete_skip/{id}', [CompanyController::class,'delete_skip'])->name('company.delete_skip');
    
    
    Route::resource('customer', CustomerController::class);
    Route::get('customer/active/{id}', [CustomerController::class,'active'])->name('customer.active');
    
    
    Route::resource('employee', EmployeeController::class);
    Route::get('employee/active/{id}', [EmployeeController::class,'active'])->name('employee.active');
    
    
    
    Route::resource('vehicles', VehicleController::class);
    Route::get('vehicles/active/{id}', [VehicleController::class,'active'])->name('vehicles.active');
    
    
    
    Route::get('billings/index/{customer_id?}', [BillingController::class,'index'])->name('billings.index');
    Route::get('billings/create', [BillingController::class,'create'])->name('billings.create');
    Route::post('billings/fetch', [BillingController::class,'fetch'])->name('billings.fetch');
    Route::post('billings/generate', [BillingController::class,'generate'])->name('billings.generate');
    Route::get('billings/edit/{billing_id}', [BillingController::class,'edit'])->name('billings.edit');
    Route::post('billings/update/{billing_id}', [BillingController::class,'update'])->name('billings.update');
    Route::get('billings/view/{billing_id}', [BillingController::class,'view'])->name('billings.view');
    Route::get('billings/generate_invoice_print/{billing_id}/{view_invoice}', [BillingController::class,'generate_invoice_print'])->name('billings.generate_invoice_print');
    Route::post('billings/generate_bulk_invoice_print', [BillingController::class,'generate_bulk_invoice_print'])->name('billings.generate_bulk_invoice_print');
    Route::post('billings/invoice_paid/{billing_id}', [BillingController::class,'invoice_paid'])->name('billings.invoice_paid');
    
    
    
    
    Route::get('report', [ReportController::class,'index'])->name('report');
    Route::post('report/fetch', [ReportController::class,'fetch'])->name('report.fetch');
});