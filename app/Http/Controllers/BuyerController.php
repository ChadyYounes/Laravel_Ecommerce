<?php

namespace App\Http\Controllers;
use App\Models\Currency;
use App\Models\Event;
use App\Models\EventBid;
use App\Models\EventParticipant;
use App\Models\StoreFollower;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BuyerController extends Controller
{
    public function buyerLayout() {
        $stores = Store::paginate(6);
        $user = Auth::user();
        $currencies=Currency::all();
//        dd($currencies);
        return view('buyerLayout.buyerStores', compact( 'stores','user','currencies'));
    }

    public function storeProductView($store_id) {
        $store = Store::find($store_id);
        $user = Auth::user();
        $response=Http::get('https://v6.exchangerate-api.com/v6/96c4bfcf9462e8a2c4748b48/latest/USD');
        $apiCurrency=$response->json();
        $product = Product::where('store_id',$store->id)->get();
        $currencies=Currency::all();
        return view('buyerLayout.storeProducts', compact( 'store','user','product','currencies','apiCurrency'));
    }
    public function viewEvents()
    {
        $events=Event::all();
        $currencies=Currency::all();
        return view('buyerLayout.viewEvents',[
            'events'=>$events,
            'user'=>Auth::user(),
            'currencies'=>$currencies
        ]);
    }
    public function myEvents()
    {
        $currencies=Currency::all();
        $events=EventParticipant::where('user_id',Auth::user()->id)->get();
        return view('buyerLayout.myEvents',[
            'events'=>$events,
            'user'=>Auth::user(),
            'currencies'=>$currencies
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

    public function updateBaseCurrency(Request $request) {
        $user = Auth::user();
        dd($request);
        $user->base_currency = $request->currency_id;
        $user->save();

        return response()->json(['message' => 'Base currency updated successfully']);
    }

}
