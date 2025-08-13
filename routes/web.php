<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;






Route::get('/', [HomeController::class,'my_home']);

Route::get('/category/{id}', [HomeController::class, 'productsByCategory'])->name('category.products');


Route::get('/home', [HomeController::class,'index']);

// Show all categories:=====================








Route::get('/add_product', [AdminController::class,'add_product']);

Route::post('/upload_product',[AdminController::class,'upload_product']);

Route::get('/view_product', [AdminController::class,'view_product']);

Route::get('/delete_product/{id}',[AdminController::class,'delete_product']);

Route::post('/edit_product/{id}',[AdminController::class,'edit_product']);

Route::get('/update_product/{id}',[AdminController::class,'update_product']);


Route::get('/product/{id}', [HomeController::class, 'productDetails'])->name('product.details');



Route::get('view_category',[AdminController::class,'view_category']); 

Route::post('add_category',[AdminController::class,'add_category']);

Route::get('delete_category/{id}',[AdminController::class,'delete_category']);

Route::get('edit_category/{id}',[AdminController::class,'edit_category']);

Route::post('update_category/{id}',[AdminController::class,'update_category']);


Route::get('/my_cart',[HomeController::class,'my_cart'])->name('my_cart');

Route::post('/add_cart/{id}',[HomeController::class,'add_cart'])->name('add_cart');

Route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart'])->name('remove_cart');

    

























Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
