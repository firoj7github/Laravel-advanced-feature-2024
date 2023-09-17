<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function loginCheck(Request $request){
    $validate= Validator::make($request->all(),[
        'email' => 'required',
        'password'=>'required',
    ]);

    if($validate->fails()){
        return response()->json($validate->erros());
    }
   }
}
