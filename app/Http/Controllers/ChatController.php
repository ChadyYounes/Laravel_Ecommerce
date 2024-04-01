<?php

namespace App\Http\Controllers;

use App\Events\chat_event;
use App\Models\chat_messages;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class ChatController extends Controller
{
    public function chatsList(){
        $role = Role::where('name', 'seller')->value('id');

        $chatsList = User::where('role_id', $role)->get();

        return view('Chat.chatsList',[
            'chatsList'=>$chatsList
        ]);
    }
    public function chatForm($receiverId){
        $receiver=User::find($receiverId);
        $sender=Auth::user();
        $messages = chat_messages::where([
            ['sender_id', '=', $sender->id],
            ['receiver_id', '=', $receiver->id]
        ])
            ->orWhere([
                ['sender_id', '=', $receiver->id],
                ['receiver_id', '=', $sender->id]
            ])
            ->orderBy('created_at')
            ->get();


//        dd($messages);
        return view('Chat.chat',[
            'receiver'=>$receiver,
            'sender'=>$sender,
            'messages'=>$messages
        ]);
    }
    public function sendMessage($receiver_id,Request $request)
    {
        $user = Auth::user();

        $chat = new chat_messages();
        $chat->sender_id = $user->id;
        $chat->receiver_id =$receiver_id;
        $chat->message_content = $request->message;
        $chat->save();

        $receiver=User::find($receiver_id);
        \broadcast(new chat_event($receiver,$request->message));

        return redirect()->route('chat_form', ['id' => $receiver_id]);
    }


}
