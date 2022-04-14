<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/shop', function () {
    return view('shop/index');
})->name('index_1');
Route::get('/shop/i2', function () {
    return view('shop/index-2');
})->name('index_2');
Route::get('/shop/shop-page', function () {
    return view('shop/shop-page');
})->name('shop_page');
Route::get('/shop/blog', function () {
    return view('shop/blog');
})->name('blog');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
