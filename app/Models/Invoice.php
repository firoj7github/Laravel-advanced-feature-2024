<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;
    
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function banner(){
        return $this->belongsTo(Banner::class, 'banner_id');
    }
}