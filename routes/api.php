<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\JobController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::get('/getHelpersDrivers/{company_id}', [MainController::class,'getHelpersDrivers'])->name('getHelpersDrivers');
Route::get('/checkActiveJob/{employee_id}', [MainController::class,'checkActiveJob'])->name('checkActiveJob');
Route::post('/jobStart', [MainController::class,'jobStart'])->name('jobStart');
Route::post('/jobEnd', [MainController::class,'jobEnd'])->name('jobEnd');
Route::get('/getDetailByUID/{id}/{asset_type}', [JobController::class,'getDetailByUID'])->name('getDetailByUID');


Route::post('/saveCollectionStep1', [JobController::class,'saveCollectionStep1'])->name('saveCollectionStep1');
Route::post('/saveCollectionStep2', [JobController::class,'saveCollectionStep2'])->name('saveCollectionStep2');
Route::post('/saveCollectionStep3', [JobController::class,'saveCollectionStep3'])->name('saveCollectionStep3');


Route::post('/dumpTrash', [JobController::class,'dumpTrash'])->name('dumpTrash');



// Route::group(['middleware' => ['auth']], function() {
//     Route::get('/getAssetDetailByUid', [AssetController::class,'getAssetDetailByUid'])->name('getAssetDetailByUid');
// });


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

