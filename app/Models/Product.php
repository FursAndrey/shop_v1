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
}
