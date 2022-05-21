<?php

namespace App\Http\My;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class Basket
{
    protected $order;

    public function __construct(bool $create = false)
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

    public function countAvailable(bool $updateCount = false)
    {
        foreach ($this->order->products AS $product) {
            //если заказанное кол-во товара превышает то что на складе - не подтверждать заказ
            if ($this->getPivotRow($product->id)->count > $product->count) {
                return false;
            }

            if ($updateCount) {
                $product->count -= $this->getPivotRow($product->id)->count;
            }
        }

        if ($updateCount) {
            $this->order->products->map->save();
        }
        return true;
    }

    public function confirmOrder(string $user_name, ?string $description)
    {
        if ($this->countAvailable(true) == false) {
            return false;
        }
        return $this->order->confirmOrder($user_name, $description);
    }

    protected function getPivotRow(int $product_id)
    {
        return $this->order->products()->where('product_id', $product_id)->first()->pivot;
    }
}