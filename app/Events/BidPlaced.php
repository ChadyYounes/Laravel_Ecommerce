<?php

namespace App\Events;

use App\Models\EventBid;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BidPlaced implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $bid;
    /**
     * Create a new event instance.
     */
    public function __construct($bid)
    {
        $this->bid=$bid;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return ['auction'];
    }
    public function broadcastAs(): string
    {
        return 'bid-event';
    }

    public function broadcastWith(): array
    {
        return [
            'name' => $this->bid['name'],
            'amount' => $this->bid['amount'],
        ];
    }
}
