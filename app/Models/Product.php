<?php

namespace App\Models;

use App\Models\Traits\dbTranslate;
use App\Services\Conversion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, dbTranslate;

    protected $fillable = [
        'short_name_ru',
        'short_name_en',
        'full_name_ru',
        'full_name_en',
        'description_ru',
        'description_en',
        'img',
        'category_id',
    ];

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }
    
    public function getImgForViewAttribute()
    {
        return 'storage/'.str_replace('\\', '/', $this->img);
    }

    public function getShortNameAttribute()
    {
        $fieldName = $this->translateThisFieldFromDB('short_name');
        return $this->$fieldName;
    }

    public function getFullNameAttribute()
    {
        $fieldName = $this->translateThisFieldFromDB('full_name');
        return $this->$fieldName;
    }

    public function getDescriptionAttribute()
    {
        $fieldName = $this->translateThisFieldFromDB('description');
        return $this->$fieldName;
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

    public function getPriceAttribute($value)
    {
        return Conversion::convert($value);
    }

    public function getCurCodeAttribute()
    {
        return Conversion::getCurCode();
    }
}
