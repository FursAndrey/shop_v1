<?php

use App\Http\Controllers\CartController;
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

Route::get('/', [PagesController::class, 'indexPage'])->name('ind_1');

Route::get('/ind-2', [PagesController::class, 'indexPage2'])->name('ind_2');
Route::get('/shop-list/{category?}', [PagesController::class, 'shop_list'])->name('shop_list');
Route::get('/about-us', [PagesController::class, 'about_us'])->name('about_us');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::get('/product-details/{product_id}', [PagesController::class, 'product_details'])->name('product_details');
Route::get('/checkout', [PagesController::class, 'checkout'])->name('checkout');
Route::get('/my-account', [PagesController::class, 'my_account'])->name('my_account');

Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/add/{product_id}', [CartController::class, 'add_product'])->name('add_product');
Route::post('/remove/{product_id}', [CartController::class, 'remove_product'])->name('remove_product');
Route::post('/order', [CartController::class, 'confirm_order'])->name('confirm_order');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
