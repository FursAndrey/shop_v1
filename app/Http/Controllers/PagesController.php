<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFilterRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sku;
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

        $skusQuery = Sku::with(['product', 'product.category']);
        if (!is_null($category)) {
            $categoryID = Category::select('id')->where('code', '=', "$category")->get()[0]['id'];
            $skusQuery->join('products', 'products.id', '=', 'skus.product_id');
            $skusQuery->where('category_id', '=', $categoryID);
            // dd($skusQuery->toSql());
        }
        if ($request->filled('min_price')) {
            $skusQuery->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $skusQuery->where('price', '<=', $request->max_price);
        }
        foreach (['hit', 'new', 'recomended'] as $field) {
            if ($request->has($field)) {
                $skusQuery->whereHas('product', function ($query) use ($field) {
                    $query->$field();
                });
            }
        }
        $skus = $skusQuery->paginate(9)->withPath('?'.$request->getQueryString());

        return view(
            'shop/shop-list',
            [
                'this_category' => $category,
                'skus' => $skus,
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

    public function sku_details(int $sku_id)
    {
        $sku = Sku::findOrFail($sku_id);
        return view(
            'shop/product-details',
            [
                'sku' => $sku,
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
