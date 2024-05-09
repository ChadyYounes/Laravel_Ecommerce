<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function getStore()
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }
}
