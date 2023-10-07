<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;


// Route::get('/', function () {
//     return view('product');
// });

Route::get('/',[ProductController::class,'products'])->name('products');
Route::post('/add-product',[ProductController::class,'addProduct'])->name('add.product');
Route::post('/update-product',[ProductController::class,'updateProduct'])->name('update.product');
Route::post('/delete-product',[ProductController::class,'deleteProduct'])->name('delete.product');

// lead add route

Route::post('/add-lead',[LeadController::class,'addlead'])->name('lead.add');

// login 
Route::get('/login',[AuthController::class,'support'])->name('login.form');


Route::post('/dealer/login',[AuthController::class,'logincheck'])->name('dealer.login');

Route::middleware(['role:1'])->group(function(){
    Route::get('/dealer/dashboard',[AuthController::class,'dashboard'])->name('dealer.dashboard');
});
Route::middleware(['role:2'])->group(function(){
    Route::get('/admin/dashboard',[AuthController::class,'admindashboard'])->name('admin.dashboard');
});

