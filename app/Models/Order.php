<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function getOrderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getUser() 
    {
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }
}
