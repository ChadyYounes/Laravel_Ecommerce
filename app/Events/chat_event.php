<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class chat_event implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $messageData;

    /**
     * Create a new event instance.
     */
    public function __construct($messageData)
    {
        $this->messageData=$messageData;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return ['chat'];
    }
    public function broadcastAs(): string
    {
        return 'chat-event';
    }
    public function broadcastWith(): array
    {
        return [
            'message_content' => $this->messageData['message_content'],
            'sender_id' => $this->messageData['sender_id'],
            'receiver_id' => $this->messageData['receiver_id'],
            'created_at' => $this->messageData['created_at'],
        ];
    }
}
