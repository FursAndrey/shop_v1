<?php

namespace App\Http\My;

use App\Mail\OrderConfirm;
use App\Models\Order;
use App\Models\Product;
use App\Services\Conversion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Basket
{
    protected $order;

    public function __construct(bool $create = false)
    {
        $order = session('order');
        if (is_null($order) && $create) {
            $data = [];
            if (Auth::check()) {
                //если пользователь авторизован - добавляем его в заказ
                $data['user_id'] = Auth::id();
            }

            $data['currency_id'] = (Conversion::getCurentCurrencyFromSession())->id;

            $this->order = new Order($data);
            session(['order' => $this->order]);
        } else {
            $this->order = $order;
        }
    }

    public function getOrder()
    {
        return (is_null($this->order)) ?[] :$this->order;
    }

    public function addProduct(Product $product)
    {
        if ($this->order->products->contains($product)) {
            $piwotRow = $this->order->products->where('id', $product->id)->first();
            //если товар уже есть в корзине - добавляем количество
            if ($piwotRow->countInOrder > $product->count) {
                return false;
            }
            $piwotRow->countInOrder++;
        } else {
            if ($product->count == 0) {
                return false;
            }
            $product->countInOrder = 1;
            //если товара в корзине нет - добавить
            
            $this->order->products->push($product);
        }
        return true;
    }

    public function removeProduct(Product $product)
    {
        $piwotRow = $this->order->products->where('id', $product->id)->first();
        if ($this->order->products->contains($product)) {
            if ($piwotRow->countInOrder < 2) {
                //если товар в корзине 1 шт - удаляем
                foreach ($this->order->products as $key => $productInOrder) {
                    if ($productInOrder->id == $product->id) {
                        unset($this->order->products[$key]);
                    }
                }
                
            } else {
                //если товар в корзине больше 1 шт - уменьшаем количество
                $piwotRow->countInOrder--;
            }
        }
    }

    public function clearBasket()
    {
        $this->order->products = [];
        session()->forget('order');
    }

    public function remveAllThisProduct(Product $product)
    {
        if ($this->order->products->contains($product->id)) {
            foreach ($this->order->products as $key => $productInOrder) {
                if ($productInOrder->id == $product->id) {
                    unset($this->order->products[$key]);
                }
            }
        }
    }

    public function countAvailable(bool $updateCount = false)
    {
        $products = collect([]);
        foreach ($this->order->products AS $productInOrder) {
            $product = Product::find($productInOrder->id);
            //если заказанное кол-во товара превышает то что на складе - не подтверждать заказ
            if ($productInOrder->countInOrder > $product->count) {
                return false;
            }

            if ($updateCount) {
                $product->count -= $productInOrder->countInOrder;
                $products->push($product);
            }
        }

        if ($updateCount) {
            $products->map->save();
        }
        return true;
    }

    public function confirmOrder(string $user_name, ?string $email, ?string $description)
    {
        if ($this->countAvailable(true) == false) {
            return false;
        }

        Mail::to($email)->send(new OrderConfirm($user_name, $this->getOrder()));

        return $this->order->confirmOrder($user_name, $description);
    }
}