<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class StoreController extends Controller
{
    public function storeForm($user_id){
        $user = User::findOrFail($user_id);
        return view('storeManagement.addStore',compact('user'));
    }

    public function storeView($user_id ) {
        $user = User::findOrFail($user_id);
        $stores = Store::where('seller_id', $user_id)->paginate(6);
        return  view('storeManagement.store', compact('user','stores'));
    }

    public function homeSellerView($user_id){
        $user = User::find($user_id);
        return  view('homeSeller',compact('user'));
    }

    
    public function SellerReportsView($user_id){
        $user = Auth::user();
        $orders = Order::all();
        return view('storeManagement.SellerReportsView',compact('user','orders' ));
    }

    public function filterOrders(Request $request)
    {
        $user = Auth::user();
        // Validate that both start and end dates are present or neither are present
    $request->validate([
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
    ]);

    // Retrieve the start and end dates
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Retrieve orders based on the date range or status
    $orders = Order::query();

    if ($startDate && $endDate) {
        $orders->whereBetween('created_at', [$startDate, $endDate]);
    } elseif ($startDate || $endDate) {
        return redirect()->back()->withErrors(['error' => 'Please provide both start and end dates or none.']);
    }

    $orders = $orders->orderBy('created_at', 'desc')->get();
        // Pass the filtered orders to the view
        return view('storeManagement.SellerReportsView', compact('orders','user'));
    }

    // Real-time filter orders by status using AJAX
    public function filterByStatus(Request $request)
    {
        // Get the status from the request
        $status = $request->input('status');

        // Query for orders based on the selected status
        $orders = Order::query();

        // Apply the filter if a specific status is selected
        if ($status && $status !== 'all') {
            $orders->where('order_status', $status);
        }

        $orders = $orders->orderBy('created_at', 'desc')->get();

        // Return the filtered orders as a JSON response for AJAX
        return response()->json([
            'orders' => $orders->map(function ($order) {
                return [
                    'id' => $order->id,
                    'buyer_name' => $order->getUser->name,
                    'total_amount' => $order->total_amount,
                    'delivery_address' => $order->delivery_address,
                    'order_status' => $order->order_status,
                    'created_at' => $order->created_at->toDateTimeString(),
                ];
            }),
        ]);
    }
    
    
    

    public function createStore(Request $request, $user_id)
{
    $user = User::find($user_id);
    $userId = Auth::id();

    // Validate the data
    $request->validate([
        'store_name' => 'required|max:255|string',
        'store_category' => 'required',
        'store_description' => 'required|max:255|string',
        'image_url' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Default image path
    $imagePath = 'stores-images/default.jpg'; 

    if ($request->hasFile('image_url')) {
        $file = $request->file('image_url');
        // Store the file and get the path
        $imagePath = $file->store('stores-images', 'public');
    }

    Store::create([
        'store_name' => $request->store_name,
        'store_category' => $request->store_category,
        'store_description' => $request->store_description,
        'image_url' => $imagePath, // Store the relative path
        'seller_id' => $userId,
    ]);

    // Redirect to the home page with success message
    return redirect()->route('storeFormView', ['user_id' => $user->id])->with('success', 'Store created successfully');
}

   public function updateView($store_id , $user_id){
    $store = Store::find($store_id);
    $user = User::find($user_id);
    return view('storeManagement.editStore',compact('store' , 'user'));
   }


public function updateStore(Request $request, $store_id)
{    $userId = Auth::id();
    $user = User::find($userId);
    
    $store = Store::findOrFail($store_id);

    $request->validate([
        'store_name' => 'required|max:255|string',
        'store_category' => 'required',
        'store_description' => 'required|max:255|string',
        'image_url' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Handle image upload if there's a new image
    if ($request->hasFile('image_url')) {
        $file = $request->file('image_url');
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . '.' . $extension;
        $path = "storage/stores-images/";
        $file->move($path, $fileName);
        $store->image_url = $path . $fileName;
    }

    $store->store_name = $request->store_name;
    $store->store_category = $request->store_category;
    $store->store_description = $request->store_description;

    $store->save();

    return redirect()->route('storeView',['user_id'=>$user->id, 'store_id' => $store->id])->with('updateSuccess', 'Store updated successfully');
}


public function deleteStore($store_id){
    $store_delete = Store::findOrFail($store_id);
    $user_id = $store_delete->seller_id;
    $store_delete->delete();
    return redirect()->route('storeView',['user_id'=>$user_id])->with('delete_success','store deleted successfully');
}
}
