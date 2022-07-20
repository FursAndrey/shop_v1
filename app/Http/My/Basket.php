<?php

namespace App\Http\My;

use App\Mail\OrderConfirm;
use App\Models\Order;
use App\Models\Sku;
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

    public function addSku(Sku $sku)
    {
        if ($this->order->skus->contains($sku)) {
            $piwotRow = $this->order->skus->where('id', $sku->id)->first();
            //если товар уже есть в корзине - добавляем количество
            if ($piwotRow->countInOrder > $sku->count) {
                return false;
            }
            $piwotRow->countInOrder++;
        } else {
            if ($sku->count == 0) {
                return false;
            }
            $sku->countInOrder = 1;
            //если товара в корзине нет - добавить
            
            $this->order->skus->push($sku);
        }
        return true;
    }

    public function removeSku(Sku $sku)
    {
        $piwotRow = $this->order->skus->where('id', $sku->id)->first();
        if ($this->order->skus->contains($sku)) {
            if ($piwotRow->countInOrder < 2) {
                //если товар в корзине 1 шт - удаляем
                foreach ($this->order->skus as $key => $skuInOrder) {
                    if ($skuInOrder->id == $sku->id) {
                        unset($this->order->skus[$key]);
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
        $this->order->skus = [];
        session()->forget('order');
    }

    public function remveAllThisSku(Sku $sku)
    {
        if ($this->order->skus->contains($sku->id)) {
            foreach ($this->order->skus as $key => $skuInOrder) {
                if ($skuInOrder->id == $sku->id) {
                    unset($this->order->skus[$key]);
                }
            }
        }
    }

    public function countAvailable(bool $updateCount = false)
    {
        $skus = collect([]);
        foreach ($this->order->skus AS $skuInOrder) {
            $sku = Sku::find($skuInOrder->id);
            //если заказанное кол-во товара превышает то что на складе - не подтверждать заказ
            if ($skuInOrder->countInOrder > $sku->count) {
                return false;
            }

            if ($updateCount) {
                $sku->count -= $skuInOrder->countInOrder;
                $skus->push($sku);
            }
        }

        if ($updateCount) {
            $skus->map->save();
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