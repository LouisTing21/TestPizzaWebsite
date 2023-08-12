<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Response;

class AuthController extends Controller
{
    //
    public function login(Request $request){
        $validation=$request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $user=User::where('email',$request->email)->first();

        if(empty($user) ||  Hash::check($request->password,$user->password)){
            return Response::json([
                'status'=>100,
                'message'=>'Credential do not match'
            ]);
        }

        $token=$user->createToken('myAppToken')->plainTextToken;
        return Response::json([
            'status'=>1000,
            'message'=>'Success',
            'token'=>$token
        ]);
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        return Response::json([
            'status'=>'Logout Success'
        ]);
    }

    public function register(Request $request){
        $validation=$request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'password'=>'required'

        ]);

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'password'=>Hash::make($request->password)
        ]);
        $token=$user->createToken('myAppToken')->plainTextToken;
        return Response::json([
            'status'=>'Success',
            'token'=>$token
        ]);
    }
}
