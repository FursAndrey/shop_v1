<?php

namespace App\Http\Controllers;

use App\Http\My\Basket;
use App\Http\Requests\ConfirmOrderRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart()
    {
        $categories = Category::select('name')->get();
        $order = (new Basket)->getOrder();
        $banner = Product::getRandomProduct();

        return view(
            'shop/cart',
            [
                'categories' => $categories,
                'banner' => $banner,
                'order' => $order,
            ]
        );
    }

    public function show_order()
    {
        $categories = Category::select('name')->get();
        $banner = Product::getRandomProduct();        
        $orders = Order::orderBy('id', 'desc')->paginate(10);
        return view(
            'shop/show_order',
            [
                'categories' => $categories,
                'banner' => $banner,
                'orders' => $orders,
                'order' => [],
            ]
        );
    }

    public function add_product(int $product_id)
    {
        $product = Product::find($product_id);
        $result = (new Basket(true))->addProduct($product);
        if ($result == true) {
            session()->flash('succes', 'Добавлен товар '.$product->full_name);
        } else {
            session()->flash('warning', 'Товар '.$product->full_name.' не доступен для заказа в большем количестве');
        }

        return redirect()->route('cart');
    }
    
    public function remove_product(int $product_id)
    {
        $product = Product::find($product_id);
        (new Basket)->removeProduct($product);
        session()->flash('warning', 'Удален товар '.$product->full_name);

        return redirect()->route('cart');
    }

    public function remove_this_product(int $product_id)
    {
        $product = Product::find($product_id);
        (new Basket)->remveAllThisProduct($product);
        session()->flash('warning', 'Удален товар '.$product->full_name);

        return redirect()->route('cart');
    }

    public function clear_cart()
    {
        (new Basket)->clearBasket();
        
        session()->flash('warning', 'Заказ удален');

        return redirect()->route('cart');
    }

    public function confirm_order(ConfirmOrderRequest $request)
    {
        $basket = new Basket;
        $email = Auth::check() ? Auth::user()->email : $request->email;
        $succes = $basket->confirmOrder($request->user_name, $email, $request->description);
        
        if ($basket->countAvailable() == false) {
            session()->flash('error', 'Товар не доступен для заказа в полном объеме');
            return redirect()->route('cart');
        } elseif ($succes) {
            session()->flash('succes', 'Заказ подтвержден');
        } else {
            session()->flash('error', 'Что-то пошло не так');
        }

        return redirect(route('ind_1'));
    }
}
