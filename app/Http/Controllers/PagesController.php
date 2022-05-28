<?php

namespace App\Http\Controllers;

use App\Http\My\Basket;
use App\Http\Requests\ProductFilterRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class PagesController extends Controller
{
    public function indexPage()
    {
        $categories = Category::select('name_ru', 'name_en', 'code')->get();
        $order = (new Basket())->getOrder();
        $products = Product::select('id', 'short_name_ru', 'short_name_en', 'img', 'price', 'count')->hit()->limit(8)->get();

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
        $categories = Category::select('name_ru', 'name_en', 'code')->get();
        $order = (new Basket)->getOrder();
        $products = Product::select('id', 'short_name_ru', 'short_name_en', 'img', 'price', 'count')->hit()->limit(8)->get();
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

        $categories = Category::select('name_ru', 'name_en', 'code')->get();
        $order = (new Basket)->getOrder();
        $banner = Product::getRandomProduct();

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
        foreach (['hit', 'new', 'recomended'] as $field) {
            if ($request->has($field)) {
                $productsQuery->$field();
            }
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
        $categories = Category::select('name_ru', 'name_en', 'code')->get();
        $order = (new Basket)->getOrder();
        $banner = Product::getRandomProduct();
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
        $categories = Category::select('name_ru', 'name_en', 'code')->get();
        $order = (new Basket)->getOrder();
        $banner = Product::getRandomProduct();
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
        $categories = Category::select('name_ru', 'name_en', 'code')->get();
        $order = (new Basket)->getOrder();
        $banner = Product::getRandomProduct();
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
        $categories = Category::select('name_ru', 'name_en', 'code')->get();
        $order = (new Basket)->getOrder();
        $banner = Product::getRandomProduct();
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
        $categories = Category::select('name_ru', 'name_en', 'code')->get();
        $order = (new Basket)->getOrder();
        $banner = Product::getRandomProduct();
        return view(
            'shop/my-account',
            [
                'categories' => $categories,
                'banner' => $banner,
                'order' => $order
            ]
        );
    }

    public function changeLocale($locale)
    {
        session(['locale' => $locale]);
        App::setLocale($locale);
        return redirect()->back();
    }
    
    public function changeCurrency($currencyCode)
    {
        session(['currency' => $currencyCode]);
        return redirect()->back();
    }
}
