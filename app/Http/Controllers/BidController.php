<?php

namespace App\Http\Controllers;

use App\Events\BidPlaced;
use App\Events\chat_event;
use App\Models\Event;
use App\Models\EventBid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class BidController extends Controller
{
    public function placeBid(Request $request)
    {
        // Retrieve the event
//        dd($request);
        $event = Event::findOrFail($request->input('event_id'));

        // Determine the current highest bid
        $currentHighestBid = EventBid::where('event_id', $event->id)
            ->max('amount');

        // If there are no previous bids, set the current highest bid to the event's starting price
        if ($currentHighestBid === null) {
            $currentHighestBid = $event->starting_price;
        }

        $minimumIncrease = $event->minimum_increase;
        $bidAmount = $request->input('bidAmount');

        // Check if the bid is higher than the current highest bid + minimum increase
        if ($bidAmount >= $currentHighestBid + $minimumIncrease) {
            // Save the bid to the database
            $bid = new EventBid();
            $bid->user_id = auth()->id(); // Assuming bids are associated with users
            $bid->event_id = $event->id;
            $bid->amount = $bidAmount;
            $bid->save();

            // Update the current highest bid in the event
            $event->current_highest_bid = $bidAmount;
            $event->save();

            // Broadcast the bid placed event using Pusher
            event(new BidPlaced([
                'name' => Auth::user()->name,
                'amount' => $bidAmount
            ]));

            return redirect()->back();
        } else {
            // Return an error response indicating that the bid is too low
            return response()->json(['error' => 'Your bid must be at least $' . ($currentHighestBid + $minimumIncrease)], 422);
        }
    }

}
