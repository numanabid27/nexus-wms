<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    public function returnSuccess($msg = "",$data){
        return response()->json(['isSuccess' => true,'message' => $msg,'data' => $data]);
    } 
    public function returnError($msg = ""){
        return response()->json(['isSuccess' => false,
        'error' => $msg]);
    }
    public function validationError($error){
        return response()->json(['errors' => $error], 422);
    }
}
