<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCartItem extends Model
{
    use HasFactory;
    public function getShoppingCart() {
        return $this->belongsTo(ShoppingCart::class, 'shopping_cart_id', 'id');
    }
    public function getProduct() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
