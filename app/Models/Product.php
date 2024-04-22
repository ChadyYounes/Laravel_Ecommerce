<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'price',
        'prodcut_url',
        'category_id',
        'store_id',
        'description',
    ];

    public function getCategory()
    {
        return $this->belongsTo(Category::class);
    }
}
