<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\HelloMail;


class AuthController extends Controller
{
    public function support(){
        return view ('dealer.login');
    }
    public function logincheck(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
       ]);


       if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
       {
        $user=Auth::user();
        if( $user->role == 1){
            return redirect()->route('dealer.dashboard');
        }elseif($user->role == 2){
            return redirect()->route('admin.dashboard');  
        }


        $data=[
            'message'=>'hello brother'
          ];
  
          Mail::to($request->email)->send(new HelloMail($data));
        
        
       

       }else
       {
        return "credential do not match!";
       }

    }

    public function dashboard(){
        return view('dealer.dealerdashboard');
    }
    public function admindashboard(){
        return view('admin.admindashboard');
    }
}
