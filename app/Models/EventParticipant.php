<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    use HasFactory;

    public function getEvent()
    {
        return $this->belongsTo(Event::class,'event_id','id');
    }
    public function getUser()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
