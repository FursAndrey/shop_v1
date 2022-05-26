<?php

namespace App\Models;

use App\Models\Traits\dbTranslate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, dbTranslate;

    protected $fillable = [
        'name_ru',
        'name_en',
        'code',
        'description_ru',
        'description_en',
    ];

    public function getDescriptionAttribute()
    {
        $fieldName = $this->translateThisFieldFromDB('description');
        return $this->$fieldName;
    }

    public function getNameAttribute()
    {
        $fieldName = $this->translateThisFieldFromDB('name');
        return $this->$fieldName;
    }
}
