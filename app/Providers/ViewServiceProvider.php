<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            [
                'shop.index', 
                'shop/index-2', 
                'shop/shop-list', 
                'shop/about-us',
                'shop/contact',
                'shop/product-details',
                'shop/checkout',
                'shop/my-account',
                'shop/cart',
                'shop/show_order',
            ], 
            'App\ViewComposers\CategoriesComposer'
        );
        View::composer(
            [
                'shop/shop-list', 
                'shop/about-us',
                'shop/contact',
                'shop/product-details',
                'shop/checkout',
                'shop/my-account',
                'shop/cart',
                'shop/show_order',
            ], 
            'App\ViewComposers\BannerComposer'
        );
        View::composer(
            [
                'shop.index', 
                'shop/index-2', 
                'shop/shop-list', 
                'shop/about-us',
                'shop/contact',
                'shop/product-details',
                'shop/checkout',
                'shop/my-account',
                'shop/cart',
            ], 
            'App\ViewComposers\OrderComposer'
        );
        View::composer(
            [
                'shop.index', 
                'shop/index-2', 
                'shop/shop-list', 
                'shop/about-us',
                'shop/contact',
                'shop/product-details',
                'shop/checkout',
                'shop/my-account',
                'shop/cart',
                'shop/show_order',
            ], 
            'App\ViewComposers\CurrenciesComposer'
        );
    }
}
