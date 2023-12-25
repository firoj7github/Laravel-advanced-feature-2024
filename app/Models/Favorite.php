<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Favorite extends Model
{
    use HasFactory;

    public static function countFavorite($Product_id){
        $countFavorite = Favorite::where(['user_id' => Auth::user()->id, 'product_id' => $Product_id]);
        return $countFavorite;  

    }
}
