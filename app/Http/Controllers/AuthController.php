<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password'=>'required'
        ]);
        
        if ($validator->fails()) {
            return $this->validationError($validator->errors());
        }
        if(Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $roles = $user->getRoleNames()->toArray();
            
            $user->unsetRelation('roles');
            $user->roles = $roles;
            
            if (array_intersect($user->roles, ['Helper', 'Driver'])) {
                // Allowed roles — proceed
                return $this->returnSuccess("Success",$user);
            } else {
                // Logout if role is not allowed
                Auth::logout();
                return $this->returnError('Access denied. Only Helpers and Drivers can log in.');
            }
        }else{
            return $this->returnError("Invalid User");
        }
    }
}
