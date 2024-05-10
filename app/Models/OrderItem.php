<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    public function getOrder()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }
    public function getProduct()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
