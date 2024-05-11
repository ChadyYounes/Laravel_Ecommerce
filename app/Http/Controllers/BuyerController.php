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
use App\Models\Category;
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
        $categories = Category::all();

        return view('buyerLayout.storeProducts', compact( 'store','user','product','categories'));
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
    public function search_category(Request $request, $store_id) {
        // Get the search value and selected category ID
        $search = $request->input('search');
        $category_id = $request->input('category');
    
        // Search in the name column from the categories table
        $categories = Category::query()
            ->where('category_name', 'LIKE', "%{$search}%")
            ->get();
    
        // Filter products by category if a category is selected
        if ($category_id) {
            $product = Product::where('store_id', $store_id)
                ->whereHas('getCategory', function ($query) use ($category_id) {
                    $query->where('category_id', $category_id);
                })
                ->get();
        } else {
            // If no category is selected, get all products for the store
            $product = Product::where('store_id', $store_id)->get();
        }
    
        $store = Store::find($store_id);
        $user = Auth::user();
    
        return view('buyerLayout.storeProducts', compact('store', 'user', 'product', 'categories'));
    }
    
    public function sort(Request $request, $store_id) {
        // Get the selected sorting option
        $sort = $request->input('sort', 'asc'); // Default sorting by ascending price
    
        // Filter products by store
        $productsQuery = Product::where('store_id', $store_id);
    
        // Sorting
        if ($sort === 'desc') {
            $product = $productsQuery->orderBy('price', 'desc')->get();
        } else {
            $product = $productsQuery->orderBy('price', 'asc')->get();
        }
    
        // Get all categories
        $categories = Category::all();
    
        $store = Store::find($store_id);
        $user = Auth::user();
    
        // Return the sorted products view with categories
        return view('buyerLayout.storeProducts', compact('store', 'user', 'product', 'categories'));
    }
    
    
    
    // Method to sort products by price
   
}
