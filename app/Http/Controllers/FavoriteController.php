<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index(){
        $products= Product::get();
        return view ('favorite.favorite', compact('products'));
    }

    public function favorite(Request $request){

        // return $request->all();

        if($request->ajax()){
            $data = $request->all();
            $countFavorite = Favorite::countFavorite($data['product_id']);
            $favorite = new Favorite();

            if($countFavorite ==0){
                $favorite->product_id =  $data['product_id'] ;
                $favorite->user_id = $data['user_id'];
                $favorite->save();
                return response()->json([
                    'status'=>'success',
                    'message'=>'Successfully added to favorite'
                ]); 
            }else{
                $user = Auth::user()->id;
                $data= Favorite::where(['product_id' => $data['product_id'], 'user_id' => $user ])->delete();
                return response()->json([
                    'action' => 'remove',
                    'message'=>'Successfully added to favorite'
                ]);
            }
        }
         
    }
}
