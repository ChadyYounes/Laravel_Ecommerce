<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chatForm(){
//        $receiver=User::find($receiverId);

        return view('chat');
    }

}
