<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\HelloMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function register(Request $request)
    {
       $validate = Validator::make($request->all(),[

            'name' => 'required|string',
            'email' =>'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' =>'required|same:password'

       ]);

       if($validate->fails())
       {
        return response()->json($validate->errors());
       }else
       {
            $buyer = new User();
            $buyer->name = $request->name;
            $buyer->email = $request->email;
            $buyer->password = Hash::make($request->password);
            $buyer->save();
            return response()->json([
                'message' =>"User Registration successfully! ",
                'status' =>1,
              
            ]);

       }





    }

    public function login(Request $request)
    {

        $validate = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',

       ]);

       if($validate->fails())
       {
        return response()->json($validate->errors());
       }


        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            $user = Auth::user();
          //   return $buyer;
          //   $token = $user->createToken($user->email)->accessToken;
            return response()->json(['status'=>true,'message'=>'Login  Successfull','user'=>$user]);
            $data=[
                'message'=>'hello brother'
              ];
      
              Mail::to($request->email)->send(new HelloMail($data));
        }

     //    elseif (Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
     //    {
     //        $user = Auth::user();
     //        $token = $user->createToken("name")->accessToken;
     //        return response()->json(['status'=>true,'message'=>'Login  Successfully!','token'=>$token,'user'=>$user]);
     //    }
        else
        {
            return response()->json(['status'=>false,'message'=>'user name or password invalid!']);
        }




    }

   }

  
