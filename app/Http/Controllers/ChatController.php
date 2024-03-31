<?php

namespace App\Http\Controllers;

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
        return view('Chat.chat',[
            'receiver'=>$receiver,
            'sender'=>$sender
        ]);
    }
    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $chat = new chat_messages();
        $chat->sender_id = $user->id;
        $chat->message_content = $request->message;
        $chat->save();

        // Pusher configuration
        $options = [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true
        ];

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data['message'] = $request->message;
        $pusher->trigger('chat-channel', 'chat-event', $data);

        return response()->json(['status' => 'Message sent']);
    }

    public function fetchMessages()
    {
        $messages = chat_messages::with('user')->latest()->take(10)->get();

        return response()->json($messages);
    }

}
