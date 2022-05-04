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
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
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
        return count($this->products);
    }

    public function confirmOrder($user_name, $description)
    {
        if ($this->status == 0) {
            $this->user_name = $user_name;
            $this->description = $description;
            $this->status = 1;
            $this->save();
            session()->forget('orderId');

            return true;
        } else {
            return false;
        }
    }
}