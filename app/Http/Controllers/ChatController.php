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
        $sellerRole = Role::where('name', 'seller')->value('id');
        $buyerRole = Role::where('name', 'buyer')->value('id');
        $chatsListBuyers = User::where('role_id',$buyerRole)->get();
        $chatsListSellers= User::where('role_id',$sellerRole)->get();
        return view('Chat.chatsList',[
            'chatsListBuyers'=>$chatsListBuyers,
            'chatsListSellers'=>$chatsListSellers,

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
        event(new chat_event([
            'message_content' => $request->message,
            'sender_id' => $user->id,
            'receiver_id' => $receiver_id,
            'created_at' => $chat->created_at->format('Y-m-d H:i:s'),
        ]));

        return redirect()->route('chat_form', ['id' => $receiver_id]);
//        return $this->response()->json(['message' => 'success']);

    }



}
