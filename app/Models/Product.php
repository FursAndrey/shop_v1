<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

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
}
