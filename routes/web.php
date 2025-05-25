<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->namespace('App\Http\Controllers')->group(function () {
    // Category
    Route::resource('categories','CategoryController');

    // Brand
    Route::resource('brands','BrandController');

    // Product
    Route::resource('products', 'ProductController');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
});
