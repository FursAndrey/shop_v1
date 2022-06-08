<?php

namespace App\Http\Controllers;

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
        $products = Product::select('id', 'short_name_ru', 'short_name_en', 'img', 'price', 'count')->hit()->limit(8)->get();

        return view(
            'shop/index',
            [
                'products' => $products,
            ]
        );
    }

    public function indexPage2()
    {
        $products = Product::select('id', 'short_name_ru', 'short_name_en', 'img', 'price', 'count')->hit()->limit(8)->get();
        return view(
            'shop/index-2',
            [
                'products' => $products,
            ]
        );
    }

    public function shop_list(ProductFilterRequest $request, $category = null)
    {
        //log example
        Log::channel('single')->info($request->ip());

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
                'this_category' => $category,
                'products' => $products,
            ]
        );
    }

    public function about_us()
    {
        return view('shop/about-us', []);
    }

    public function contact()
    {
        return view('shop/contact', []);
    }

    public function product_details(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        return view(
            'shop/product-details',
            [
                'product' => $product,
            ]
        );
    }

    public function checkout()
    {
        return view('shop/checkout', []);
    }

    public function my_account()
    {
        return view('shop/my-account', []);
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
