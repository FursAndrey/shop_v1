<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFilterRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PagesController extends Controller
{
    public function indexPage()
    {
        $categories = Category::select('name', 'code')->get();
        $order = CartController::getOrder();
        $products = Product::select('id', 'short_name', 'img', 'price')->limit(8)->get();

        return view(
            'shop/index',
            [
                'categories' => $categories,
                'products' => $products,
                'order' => $order
            ]
        );
    }

    public function indexPage2()
    {
        $categories = Category::select('name', 'code')->get();
        $order = CartController::getOrder();
        $products = Product::select('id', 'short_name', 'img', 'price')->limit(8)->get();
        return view(
            'shop/index-2',
            [
                'categories' => $categories,
                'products' => $products,
                'order' => $order
            ]
        );
    }

    public function shop_list(ProductFilterRequest $request, $category = null)
    {
        //log example
        Log::channel('single')->info($request->ip());

        $categories = Category::select('name', 'code')->get();
        $order = CartController::getOrder();
        $banner = Product::inRandomOrder()->limit(1)->get()[0];

        $productsQuery = Product::query();
        if (!is_null($category)) {
            $categoryID = Category::select('id')->where('code', '=', "$category")->get()[0]['id'];
            $productsQuery->where('category_id', '=', $categoryID);
        }
        if ($request->filled('min_price')) {
            $productsQuery->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $productsQuery->where('price', '<=', $request->max_price);
        }
        if ($request->filled('hit')) {
            $productsQuery->where('hit', '=', 1);
        }
        if ($request->filled('new')) {
            $productsQuery->where('new', '=', 1);
        }
        if ($request->filled('recomended')) {
            $productsQuery->where('recomended', '=', 1);
        }
        $products = $productsQuery->paginate(9)->withPath('?'.$request->getQueryString());
        
        return view(
            'shop/shop-list',
            [
                'categories' => $categories,
                'this_category' => $category,
                'products' => $products,
                'banner' => $banner,
                'order' => $order
            ]
        );
    }

    public function about_us()
    {
        $categories = Category::select('name', 'code')->get();
        $order = CartController::getOrder();
        $banner = Product::inRandomOrder()->limit(1)->get()[0];
        return view(
            'shop/about-us',
            [
                'categories' => $categories,
                'banner' => $banner,
                'order' => $order
            ]
        );
    }

    public function contact()
    {
        $categories = Category::select('name', 'code')->get();
        $order = CartController::getOrder();
        $banner = Product::inRandomOrder()->limit(1)->get()[0];
        return view(
            'shop/contact',
            [
                'categories' => $categories,
                'banner' => $banner,
                'order' => $order
            ]
        );
    }

    public function product_details(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        $categories = Category::select('name', 'code')->get();
        $order = CartController::getOrder();
        $banner = Product::inRandomOrder()->limit(1)->get()[0];
        return view(
            'shop/product-details',
            [
                'categories' => $categories,
                'product' => $product,
                'banner' => $banner,
                'order' => $order
            ]
        );
    }

    public function checkout()
    {
        $categories = Category::select('name', 'code')->get();
        $order = CartController::getOrder();
        $banner = Product::inRandomOrder()->limit(1)->get()[0];
        return view(
            'shop/checkout',
            [
                'categories' => $categories,
                'banner' => $banner,
                'order' => $order
            ]
        );
    }

    public function my_account()
    {
        $categories = Category::select('name', 'code')->get();
        $order = CartController::getOrder();
        $banner = Product::inRandomOrder()->limit(1)->get()[0];
        return view(
            'shop/my-account',
            [
                'categories' => $categories,
                'banner' => $banner,
                'order' => $order
            ]
        );
    }
}
