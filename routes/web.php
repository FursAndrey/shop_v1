<?php

use App\Http\Controllers\PagesController;
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

Route::get('/shop', [PagesController::class, 'indexPage'])->name('ind_1');

Route::get('/shop/ind-2', [PagesController::class, 'indexPage2'])->name('ind_2');
Route::get('/shop/shop-page', [PagesController::class, 'shop_page'])->name('shop_page');
Route::get('/shop/shop-list', [PagesController::class, 'shop_list'])->name('shop_list');
Route::get('/shop/about-us', [PagesController::class, 'about_us'])->name('about_us');
Route::get('/shop/contact', [PagesController::class, 'contact'])->name('contact');
Route::get('/shop/product-details/{product_id}', [PagesController::class, 'product_details'])->name('product_details');
Route::get('/shop/cart', [PagesController::class, 'cart'])->name('cart');
Route::get('/shop/checkout', [PagesController::class, 'checkout'])->name('checkout');
Route::get('/shop/wishlist', [PagesController::class, 'wishlist'])->name('wishlist');
Route::get('/shop/my-account', [PagesController::class, 'my_account'])->name('my_account');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
