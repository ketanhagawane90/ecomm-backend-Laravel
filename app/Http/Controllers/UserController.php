<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    function register(Request $req)
    {
        //return "Hello";
        $user=new User;
        $user->name=$req->input("name");
        $user->email=$req->input("email");
        $user->password=Hash::make($req->input("password"));
        $user->save();
        return $user;
    }
    
    function login(Request $req)
    {
       //return "Hello";
       $user=User::where('email',$req->email)->first();       
       if(!$user || !Hash::check($req->password,$user->password))
       {
        // return response([
        //     'error'=>["Email or Password is not matched"]
        // ]);
        return response()->json(['message' => 'Invalid credentials'], 401);
       }
       return $user;
    }
}
