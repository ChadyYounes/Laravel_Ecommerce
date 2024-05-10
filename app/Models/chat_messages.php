<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chat_messages extends Model
{
    use HasFactory;

    public function getBuyer()
    {
        return $this->belongsTo(User::class,'sender_id','id');
    }
}
