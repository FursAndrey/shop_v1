<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function indexPage()
    {
        $categories = Category::select('name')->get();
        $products = Product::select('id', 'short_name', 'img', 'price')->limit(8)->get();
        return view(
            'shop/index',
            [
                'categories' => $categories,
                'products' => $products
            ]
        );
    }

    public function indexPage2()
    {
        $categories = Category::select('name')->get();
        $products = Product::select('id', 'short_name', 'img', 'price')->limit(8)->get();
        return view(
            'shop/index-2',
            [
                'categories' => $categories,
                'products' => $products
            ]
        );
    }

    public function shop_page()
    {
        $categories = Category::select('name')->get();
        $products = Product::select('id', 'short_name', 'img', 'price', 'description')->paginate(9);
        $banner = Product::inRandomOrder()->limit(1)->get()[0];
        return view(
            'shop/shop-page',
            [
                'categories' => $categories,
                'products' => $products,
                'banner' => $banner,
            ]
        );
    }

    public function shop_list()
    {
        $categories = Category::select('name')->get();
        $products = Product::select('id', 'short_name', 'img', 'price', 'description')->paginate(9);
        $banner = Product::inRandomOrder()->limit(1)->get()[0];
        return view(
            'shop/shop-list',
            [
                'categories' => $categories,
                'products' => $products,
                'banner' => $banner,
            ]
        );
    }

    public function about_us()
    {
        $categories = Category::select('name')->get();
        $banner = Product::inRandomOrder()->limit(1)->get()[0];
        return view(
            'shop/about-us',
            [
                'categories' => $categories,
                'banner' => $banner,
            ]
        );
    }

    public function contact()
    {
        $categories = Category::select('name')->get();
        $banner = Product::inRandomOrder()->limit(1)->get()[0];
        return view(
            'shop/contact',
            [
                'categories' => $categories,
                'banner' => $banner,
            ]
        );
    }

    public function product_details(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        $categories = Category::select('name')->get();
        $banner = Product::inRandomOrder()->limit(1)->get()[0];
        return view(
            'shop/product-details',
            [
                'categories' => $categories,
                'product' => $product,
                'banner' => $banner,
            ]
        );
    }

    public function cart()
    {
        $categories = Category::select('name')->get();
        $banner = Product::inRandomOrder()->limit(1)->get()[0];
        return view(
            'shop/cart',
            [
                'categories' => $categories,
                'banner' => $banner,
            ]
        );
    }

    public function checkout()
    {
        $categories = Category::select('name')->get();
        $banner = Product::inRandomOrder()->limit(1)->get()[0];
        return view(
            'shop/checkout',
            [
                'categories' => $categories,
                'banner' => $banner,
            ]
        );
    }

    public function wishlist()
    {
        $categories = Category::select('name')->get();
        $banner = Product::inRandomOrder()->limit(1)->get()[0];
        return view(
            'shop/wishlist',
            [
                'categories' => $categories,
                'banner' => $banner,
            ]
        );
    }

    public function my_account()
    {
        $categories = Category::select('name')->get();
        $banner = Product::inRandomOrder()->limit(1)->get()[0];
        return view(
            'shop/my-account',
            [
                'categories' => $categories,
                'banner' => $banner,
            ]
        );
    }
}
