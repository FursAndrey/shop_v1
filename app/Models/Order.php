<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'user_name',
        'description',
        'user_id',
        'currency_id',
        'sum',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['count', 'price'])->withTimestamps();
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function getOrderSum()
    {
        $sum = 0;
        foreach ($this->products as $product) {
            $sum += $product->getPriceForCountAttribute();
        }
        return $sum;
    }

    public function getCountProductsAttribute()
    {
        return $this->products()->count();
    }

    public function confirmOrder(string $user_name, ?string $description)
    {
        $this->user_name = $user_name;
        $this->description = $description;
        $this->status = 1;
        $this->sum = $this->getOrderSum();
        $this->save();

        foreach ($this->products as $productInOrder) {
            $this->products()->attach(
                $productInOrder,
                [
                    'count' => $productInOrder->countInOrder,
                    'price' => $productInOrder->price,
                ]
            );
        }
        session()->forget('order');

        return true;
    }
}
