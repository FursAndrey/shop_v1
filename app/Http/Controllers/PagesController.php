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
        $products = Product::select('short_name', 'img', 'price')->limit(8)->get();
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
        $products = Product::select('short_name', 'img', 'price')->limit(8)->get();
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
        return view(
            'shop/shop-page',
            [
                'categories' => $categories,
                'products' => $products
            ]
        );
    }

    public function shop_list()
    {
        $categories = Category::select('name')->get();
        return view(
            'shop/shop-list',
            [
                'categories' => $categories
            ]
        );
    }

    public function about_us()
    {
        $categories = Category::select('name')->get();
        return view(
            'shop/about-us',
            [
                'categories' => $categories
            ]
        );
    }

    public function contact()
    {
        $categories = Category::select('name')->get();
        return view(
            'shop/contact',
            [
                'categories' => $categories
            ]
        );
    }

    public function product_details()
    {
        $categories = Category::select('name')->get();
        return view(
            'shop/product-details',
            [
                'categories' => $categories
            ]
        );
    }

    public function cart()
    {
        $categories = Category::select('name')->get();
        return view(
            'shop/cart',
            [
                'categories' => $categories
            ]
        );
    }

    public function checkout()
    {
        $categories = Category::select('name')->get();
        return view(
            'shop/checkout',
            [
                'categories' => $categories
            ]
        );
    }

    public function wishlist()
    {
        $categories = Category::select('name')->get();
        return view(
            'shop/wishlist',
            [
                'categories' => $categories
            ]
        );
    }

    public function my_account()
    {
        $categories = Category::select('name')->get();
        return view(
            'shop/my-account',
            [
                'categories' => $categories
            ]
        );
    }
}
