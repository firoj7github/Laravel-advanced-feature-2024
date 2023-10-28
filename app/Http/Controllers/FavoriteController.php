<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(){
        $products= Product::get();
        return view ('favorite.favorite', compact('products'));
    }
}
