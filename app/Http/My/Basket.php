<?php

namespace App\Http\My;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class Basket
{
    protected $order;

    public function __construct($create = false)
    {
        $orderId = session('orderId');
        if (is_null($orderId) && $create) {

            $data = [];
            if (Auth::check()) {
                //если пользователь авторизован - добавляем его в заказ
                $data['user_id'] = Auth::id();
            }

            $this->order = Order::create($data);
            session(['orderId' => $this->order->id]);
        } else {
            $this->order = Order::find($orderId);
        }
    }

    public function getOrder()
    {
        return (is_null($this->order)) ?[] :$this->order;
    }

    public function addProduct(Product $product)
    {
        if ($this->order->products->contains($product->id)) {
            //если товар уже есть в корзине - добавляем количество
            $pivotRow = $this->getPivotRow($product->id);
            $pivotRow->count++;

            if ($pivotRow->count > $product->count) {
                return false;
            }

            $pivotRow->update();
        } else {
            if ($product->count == 0) {
                return false;
            }
            //если товара в корзине нет - добавить
            $this->order->products()->attach($product->id);
        }
        return true;
    }

    public function removeProduct(Product $product)
    {
        if ($this->order->products->contains($product->id)) {
            $pivotRow = $this->getPivotRow($product->id);
            if ($pivotRow->count < 2) {
                //если товар в корзине 1 шт - удаляем
                $this->order->products()->detach($product->id);
            } else {
                //если товар в корзине больше 1 шт - уменьшаем количество
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
    }

    public function clearBasket()
    {
        foreach ($this->order->products as $product) {
            $this->order->products()->detach($product->id);
        }
        $this->order->delete();
        session()->forget('orderId');
    }

    public function remveAllThisProduct(Product $product)
    {
        if ($this->order->products->contains($product->id)) {
            $this->order->products()->detach($product->id);
        }
    }

    public function countAvailable()
    {
        foreach ($this->order->products AS $product) {
            //если заказанное кол-во товара превышает то что на складе - не подтверждать заказ
            if ($this->getPivotRow($product->id)->count > $product->count) {
                return false;
            }
        }
        return true;
    }

    protected function getPivotRow(int $product_id)
    {
        return $this->order->products()->where('product_id', $product_id)->first()->pivot;
    }
}