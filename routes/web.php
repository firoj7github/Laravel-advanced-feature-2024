<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;



// Route::get('/', function () {
//     return view('product');
// });

Route::get('/',[ProductController::class,'products'])->name('products');
Route::post('/add-product',[ProductController::class,'addProduct'])->name('add.product');
Route::post('/update-product',[ProductController::class,'updateProduct'])->name('update.product');
Route::post('/delete-product',[ProductController::class,'deleteProduct'])->name('delete.product');
