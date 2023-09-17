<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function products(){
        $products= Product::latest()->paginate(5);
        return view('product', compact('products'));
    }

    public function addProduct(Request $request){
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        $product= new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();
        return response()->json([
            'status'=>'success',
        ]);
    }

    public function updateProduct(Request $request){
         Product::where('id', $request->up_id)->update([
            'name'=>$request->up_name,
            'price'=>$request->up_price,
            
         ]);
         return response()->json([
            'status'=>'success',
         ]);
    }

    public function deleteProduct(Request $request){
        Product::find($request->product_id)->delete();
        return response()->json([
            'status'=>'success'
        ]);
    }
}
