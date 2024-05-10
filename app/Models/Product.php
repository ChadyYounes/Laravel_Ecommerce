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
        'product_url',
        'category_id',
        'store_id',
        'quantity',
        'description',
    ];

    public function getCategory()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function getShoppingCartItem() {
        return $this->hasOne(ShoppingCartItem::class);
    }
    public function getOrderItem()
    {
        return $this->hasOne(OrderItem::class);
    }
    public function getStore()
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }
}
