<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\EventBid;
use App\Models\EventParticipant;
use App\Models\StoreFollower;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function buyerLayout() {
        $stores = Store::paginate(6);
        $user = Auth::user();
        return view('buyerLayout.buyerStores', compact( 'stores','user'));
    }

    public function storeProductView($store_id) {
        $store = Store::find($store_id);
        $user = Auth::user();
        $product = Product::where('store_id',$store->id)->get();

        return view('buyerLayout.storeProducts', compact( 'store','user','product'));
    }
    public function viewEvents()
    {
        $events=Event::all();

        return view('buyerLayout.viewEvents',[
            'events'=>$events,
            'user'=>Auth::user()
        ]);
    }
    public function myEvents()
    {
        $events=EventParticipant::where('user_id',Auth::user()->id)->get();
        return view('buyerLayout.myEvents',[
            'events'=>$events,
            'user'=>Auth::user()
        ]);
    }
    public function subscribeToEvent(Request $request)
    {
        $event_participant=new EventParticipant();

        $event_participant->event_id=$request->input('event_id');
        $event_participant->user_id=Auth::user()->id;

        $event_participant->save();

        return redirect()->route('myEvents');
    }
    public function unsubscribeFromEvent(Request $request)
    {
        $event=EventParticipant::find($request->input('event_id'));

        $event->delete();

        return redirect()->back();
    }

    public function liveBidding($eventId)
    {
        $event=Event::find($eventId);
        $eventBids = EventBid::where('event_id', $eventId)->orderBy('created_at', 'asc')->get();
//        dd($eventBids);
        $currentHighestBid = EventBid::where('event_id', $event->id)
            ->orderByDesc('amount')
            ->first();
        $currentBid=$currentHighestBid?:null;
//        dd($event);
        return view('buyerLayout.liveBidding',[
            'event'=>$event,
            'eventBids'=>$eventBids,
            'currentBid'=>$currentBid
        ]);
    }

    public function followStore(Request $request)
    {
        $follow=new StoreFollower();

        $follow->user_id=Auth::id();
        $follow->store_id=$request->input('store_id');
//        dd($follow);
        $follow->save();

        return redirect()->back();
    }

    public function unfollowStore(Request $request)
    {
        $follow=StoreFollower::where('store_id',$request->input('store_id'));
        $follow->delete();
        return redirect()->back();
    }

}
