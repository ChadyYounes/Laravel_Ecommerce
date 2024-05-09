<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_name',
        'store_category',
        'store_description',
        'image_url',
        'seller_id'
    ] ;
    public function getUser()
    {
        return $this->belongsTo(User::class,"seller_id", "id");
    }

    public function getEvents()
    {
        return $this->hasMany(Event::class,'store_id','id');
    }

}


