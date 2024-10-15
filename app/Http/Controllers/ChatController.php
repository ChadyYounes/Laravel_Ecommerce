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
    // public function chatsList(){
    //     $user = Auth::user();
    //     // Get all chat messages where the logged-in user is the receiver
    //     $chatsListBuyers = chat_messages::where('receiver_id', Auth::id())
    //         ->get()
    //         ->unique('sender_id'); // Ensure unique buyers based on their sender ID
    
    //     return view('Chat.chatsList', [
    //         'chatsListBuyers' => $chatsListBuyers,
    //         'user' => $user
    //     ]);
    // }
    public function chatsList(Request $request)
    {
        $user = Auth::user();
    
        if ($user->getRole->name === "seller") {
            // Retrieve all buyers the seller has interacted with
            $chatsListBuyers = DB::table('chat_messages')
                ->join('users', 'chat_messages.sender_id', '=', 'users.id')
                ->join('stores', 'stores.seller_id', '=', 'chat_messages.receiver_id')
                ->where('chat_messages.receiver_id', $user->id)
                ->select('users.id as buyer_id', 'users.name as buyer_name', 'users.email as buyer_email', 'stores.store_name as store_name')
                ->distinct()
                ->get();
            
            return view('Chat.chatsList', [
                'chats' => $chatsListBuyers,
                'user' => $user
            ]);
        } else {
            // Retrieve all sellers the buyer has interacted with
            $chatsListSellers = DB::table('chat_messages')
                ->join('users', 'chat_messages.receiver_id', '=', 'users.id')
                ->join('stores', 'stores.seller_id', '=', 'chat_messages.receiver_id')
                ->where('chat_messages.sender_id', $user->id)
                ->select('users.id as seller_id', 'users.name as seller_name', 'stores.store_name as store_name')
                ->distinct()
                ->get();
            
            return view('Chat.chatsList', [
                'chats' => $chatsListSellers,
                'user' => $user
            ]);
        }
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
    }

    public function clearMessages($receiver_id)
    {
        $user = Auth::user();
    
        // Delete all messages between the user and the specified receiver
        chat_messages::where(function($query) use ($user, $receiver_id) {
            $query->where('sender_id', $user->id)->where('receiver_id', $receiver_id);
        })->orWhere(function($query) use ($user, $receiver_id) {
            $query->where('sender_id', $receiver_id)->where('receiver_id', $user->id);
        })->delete();
    
        return redirect()->route('chat_form', ['receiverId' => $receiver_id])->with('success', 'Messages cleared successfully.');
    }
     

}
