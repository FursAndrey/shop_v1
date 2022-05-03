<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        $categories = Category::select('name')->get();
        $order = self::getOrder();
        $banner = Product::inRandomOrder()->limit(1)->get()[0];        

        return view(
            'shop/wishlist',
            [
                'categories' => $categories,
                'banner' => $banner,
                'order' => $order,
            ]
        );
    }

    public function add_product(int $product_id)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }
        if ($order->products->contains($product_id)) {
            //если товар уже есть в корзине - добавляем количество
            $pivotRow = $order->products()->where('product_id', $product_id)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            //если товара в корзине нет - добавить
            $order->products()->attach($product_id);
        }

        $product = Product::find($product_id);
        session()->flash('succes', 'Добавлен товар '.$product->full_name);

        return redirect()->route('cart');
    }
    
    public function remove_product(int $product_id)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('cart');
        } else {
            $order = Order::find($orderId);
            
            if ($order->products->contains($product_id)) {
                $pivotRow = $order->products()->where('product_id', $product_id)->first()->pivot;
                if ($pivotRow->count < 2) {
                    //если товар в корзине 1 шт - удаляем
                    $order->products()->detach($product_id);
                } else {
                    //если товар в корзине больше 1 шт - уменьшаем количество
                    $pivotRow->count--;
                    $pivotRow->update();
                }
            }
        }
        $product = Product::find($product_id);
        session()->flash('warning', 'Удален товар '.$product->full_name);

        return redirect()->route('cart');
    }

    public function confirm_order(Request $request)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect(route('ind_1'));
        }
        $order = Order::find($orderId);
        $succes = $order->confirmOrder($request->user_name, $request->description);

        if ($succes) {
            session()->flash('succes', 'Заказ подтвержден');
        } else {
            session()->flash('error', 'Что-то пошло не так');
        }
        

        return redirect(route('ind_1'));
    }

    public static function getOrder()
    {
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::find($orderId);
        } else {
            $order = [];
        }
        return $order;
    }
}
