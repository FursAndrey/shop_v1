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

Route::group(
    ['middleware' => 'changeLocale'],
    function () {
        Route::get('/', [PagesController::class, 'indexPage'])->name('ind_1');
        
        Route::get('/ind-2', [PagesController::class, 'indexPage2'])->name('ind_2');
        Route::get('/shop-list/{category?}', [PagesController::class, 'shop_list'])->name('shop_list');
        Route::get('/about-us', [PagesController::class, 'about_us'])->name('about_us');
        Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
        Route::get('/product-details/{sku_id}', [PagesController::class, 'sku_details'])->name('sku_details');
        Route::get('/my-account', [PagesController::class, 'my_account'])->name('my_account');
        
        Route::get('/changeLocale/{locale}', [PagesController::class, 'changeLocale'])->name('changeLocale');
        Route::get('/changeCurrency/{currencyCode}', [PagesController::class, 'changeCurrency'])->name('changeCurrency');
        
        Route::group(
            ['middleware' => 'cartCheck'],
            function () {
                Route::get('/checkout', [PagesController::class, 'checkout'])->name('checkout');
                Route::get('/cart', [CartController::class, 'cart'])->name('cart');
                Route::post('/remove/{sku_id}', [CartController::class, 'remove_sku'])->name('remove_product');
                Route::post('/remove_this_sku/{sku_id}', [CartController::class, 'remove_this_sku'])->name('remove_this_product');
                Route::post('/clear_cart', [CartController::class, 'clear_cart'])->name('clear_cart');
                Route::post('/confirm_order', [CartController::class, 'confirm_order'])->name('confirm_order');
            }
        );
        
        Route::post('/add/{sku_id}', [CartController::class, 'add_sku'])->name('add_product');
        
        Route::get('/show_order', [CartController::class, 'show_order'])->middleware(['auth', 'isAdmin'])->name('show_order');
    }
);

require __DIR__.'/auth.php';

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
