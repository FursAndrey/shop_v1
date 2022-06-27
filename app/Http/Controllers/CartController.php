<?php

namespace App\Http\Controllers;

use App\Http\My\Basket;
use App\Http\Requests\ConfirmOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart()
    {
        return view('shop/cart', []);
    }

    public function show_order()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(10);
        return view(
            'shop/show_order',
            [
                'orders' => $orders,
                'order' => [],
            ]
        );
    }

    public function add_sku(int $sku_id)
    {
        $sku = Sku::find($sku_id);
        $result = (new Basket(true))->addSku($sku);
        if ($result == true) {
            session()->flash('succes', __('cartContr.added_product').$sku->product->full_name);
        } else {
            session()->flash('warning', __('cartContr.product').$sku->product->full_name.__('cartContr.not_available'));
        }

        return redirect()->route('cart');
    }
    
    public function remove_sku(int $sku_id)
    {
        $sku = Sku::find($sku_id);
        (new Basket)->removeSku($sku);
        session()->flash('warning', __('cartContr.deleted_product').$sku->product->full_name);

        return redirect()->route('cart');
    }

    public function remove_this_sku(int $sku_id)
    {
        $sku_id = Sku::find($sku_id);
        (new Basket)->remveAllThisSku($sku_id);
        session()->flash('warning', __('cartContr.deleted_product').$sku_id->product->full_name);

        return redirect()->route('cart');
    }

    public function clear_cart()
    {
        (new Basket)->clearBasket();
        
        session()->flash('warning', __('cartContr.deleted_order'));

        return redirect()->route('cart');
    }

    public function confirm_order(ConfirmOrderRequest $request)
    {
        $basket = new Basket;
        $email = Auth::check() ? Auth::user()->email : $request->email;
        $succes = $basket->confirmOrder($request->user_name, $email, $request->description);
        
        if ($basket->countAvailable() == false) {
            session()->flash('error', __('cartContr.product_not_available'));
            return redirect()->route('cart');
        } elseif ($succes) {
            session()->flash('succes', __('cartContr.order_confirmed'));
        } else {
            session()->flash('error', __('cartContr.unknown_error'));
        }

        return redirect(route('ind_1'));
    }
}
