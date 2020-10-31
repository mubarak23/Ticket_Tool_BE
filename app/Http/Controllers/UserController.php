<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Actions\AuthService;
use App\Actions\UserAccountService;
use App\User;
use App\Actions\GenerateJWTTokenAction;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //

    public function RegisterAccount(Request $request, UserAccountService $UserAccountService){

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors(), 401);
         }
         $data = $request->all();

         $data['password'] = Hash::make($data['password']);
         $new_account = $UserAccountService->execute($data);
         if($new_account){
             return response()->json(['message' => 'User Account Created Successfully'], 201);
         }
         return response()->json(['message' => 'User Account Creation Failed, Try Again'], 400);
    }


    public function AuthLogin(Request $request, AuthService $AuthService){
        $validation = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors(), 401);
         }

         $data = $request->all();
         $authlogin = $AuthService->execute($data);
         return $authlogin;
    }


}
