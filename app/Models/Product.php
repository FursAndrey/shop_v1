<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'short_name',
        'full_name',
        'description',
        'img',
        'category_id',
    ];
    
    public function getImgForViewAttribute()
    {
        return 'storage/'.str_replace('\\', '/', $this->img);
    }

    public function getPriceForCountAttribute()
    {
        if (!is_null($this->pivot)) {
            return $this->price * $this->pivot->count;
        } else {
            return $this->price;
        }
    }

    public function isNew()
    {
        return ($this->new === '1')? 1: 0;
    }
    public function isHit()
    {
        return ($this->hit === '1')? 1: 0;
    }
    public function isRecomended()
    {
        return ($this->recomended === '1')? 1: 0;
    }

    public function scopeHit($query)
    {
        return $query->where('hit', 1);
    }
    public function scopeNew($query)
    {
        return $query->where('new', 1);
    }
    public function scopeRecomended($query)
    {
        return $query->where('recomended', 1);
    }

    public static function getRandomProduct()
    {
        $countProducts = self::count();
        $randProd = random_int(1, $countProducts);
        return self::limit(1)->offset($randProd)->withTrashed()->get()[0];
    }
}
