<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Favorite extends Model
{
    use HasFactory;

    
    

public static function countFavorite($product_id)
{
    $countFavorite = Favorite::where(['user_id' => Auth::id(), 'product_id' => $product_id])->count();
    return $countFavorite;
}

}
