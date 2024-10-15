<?php

namespace App\Http\Controllers;
use App\Models\Currency;
use App\Models\Event;
use App\Models\EventBid;
use App\Models\EventParticipant;
use App\Models\ProductReview;
use App\Models\StoreFollower;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Http;

class BuyerController extends Controller
{
    public function buyerLayout() {
        $stores = Store::paginate(6);
        $total_stores = Store::count();
        $user = Auth::user();
        $currencies=Currency::all();
        $categories = Category::all();
        $user = Auth::user();
//        dd($currencies);
        return view('buyerLayout.buyerStores', compact( 'stores','total_stores','user','currencies','categories', 'user' ));
    }

    public function storeProductView($store_id) {
        $store = Store::find($store_id);
        $user = Auth::user();
        $response=Http::get('https://v6.exchangerate-api.com/v6/96c4bfcf9462e8a2c4748b48/latest/USD');
        $apiCurrency=$response->json();
        $product = Product::where('store_id',$store->id)->get();
        $categories = Category::all();

        $currencies=Currency::all();
        return view('buyerLayout.storeProducts', compact( 'store','user','product','currencies','apiCurrency','categories'));
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
   

    public function updateBaseCurrency(Request $request) {
        $user = Auth::user();
        dd($request);
        $user->base_currency = $request->currency_id;
        $user->save();

        return response()->json(['message' => 'Base currency updated successfully']);
    }

    public function addProductReview($productId)
    {
        $product=Product::find($productId);
        $reviews=ProductReview::where('product_id',$productId)->get();
        $count=ProductReview::where('product_id',$productId)->count();
        $currencies=Currency::all();
        return view('buyerLayout.addProductReview',[
            'currencies'=>$currencies,
            'user'=>Auth::user(),
            'product'=>$product,
            'reviews'=>$reviews,
            'count'=>$count
        ]);
    }
    public function addProductReviewStore(Request $request)
    {
        $review=new ProductReview();
        $review->user_id=Auth::id();
        $review->product_id=$request->input('product_id');
        $review->review=$request->input('review');
        $review->save();

        return redirect()->back();
    }
    //Filters
    public function filterStores(Request $request) {
        $query = Store::query();
    
        // Search by store name
        if ($request->has('store_name')) {
            $query->where('store_name', 'LIKE', '%' . $request->store_name . '%');
        }
    
        // Filter by store category
        if ($request->has('store_category') && $request->store_category) {
            $query->where('store_category', $request->store_category);
        }
    
        $stores = $query->paginate(6);
    
        return response()->json([
            'html' => view('buyerLayout.storeList', compact('stores'))->render()
        ]);
    }
    
    
    
}
