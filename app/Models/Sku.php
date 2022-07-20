<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sku extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'count',
        'price',
    ];

    protected $visible = [
        'id',
        'count',
        'price',
        'product_info',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function propertyOptions()
    {
        return $this->belongsToMany(PropertyOption::class);
    }
    
    public function getPriceForCountAttribute()
    {
        return $this->price * $this->countInOrder;
    }

    public function scopeAvailable($query)
    {
        return $query->where('count', '>', 0);
    }

    public function getProductInfoAttribute()
    {
        return $this->product;
    }
}
