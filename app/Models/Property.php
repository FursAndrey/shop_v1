<?php

namespace App\Models;

use App\Models\Traits\dbTranslate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, dbTranslate, SoftDeletes;
    
    protected $fillable = [
        'name_en',
        'name_ru',
    ];

    public function getNameAttribute()
    {
        $fieldName = $this->translateThisFieldFromDB('name');
        return $this->$fieldName;
    }

    public function propertyOptions()
    {
        return $this->hasMany(PropertyOption::class);
    }
    
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
