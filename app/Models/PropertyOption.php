<?php

namespace App\Models;

use App\Models\Traits\dbTranslate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyOption extends Model
{
    use HasFactory, dbTranslate, SoftDeletes;
    
    protected $fillable = [
        'property_id',
        'name_en',
        'name_ru',
    ];

    public function getNameAttribute()
    {
        $fieldName = $this->translateThisFieldFromDB('name');
        return $this->$fieldName;
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function skus()
    {
        return $this->belongsToMany(Sku::class);
    }
}
