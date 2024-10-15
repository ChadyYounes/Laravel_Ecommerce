<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Store;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\StoreFollower;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function homeView(Request $request) {
        $user = Auth::user();
        // Check if the user is authenticated
        if ($user) {
            switch ($user->role_id) {
                case 1:
                    // Buyer
                    $currencies=Currency::all();
                    return view('homes.homeBuyer', compact('user','currencies'));
                    break;
                case 2:
                //// Seller
                $selectedDate = $request->input('date', Carbon::today()->format('Y-m-d')); 
                $stores = Store::where('seller_id', $user->id)->with('getProducts')->get();
                   // Calculate total orders on selected date
                   $total_orders = Order::whereDate('created_at', $selectedDate)->count();


                // Calculate total products sold on selected date
                $totalProductsSoldToday = OrderItem::whereHas('getProduct', function ($query) use ($user) {
                    $query->whereHas('getStore', function ($query) use ($user) {
                        $query->where('seller_id', $user->id);
                    });
                })
                ->whereHas('getOrder', function ($query) {
                    $query->where('order_status', 'delivered');
                })
                ->whereDate('created_at', $selectedDate)
                ->sum('quantity');

                // Calculate total amount gained on selected date
                $totalAmountGainedToday = OrderItem::whereHas('getProduct', function ($query) use ($user) {
                    $query->whereHas('getStore', function ($query) use ($user) {
                        $query->where('seller_id', $user->id);
                    });//
                })
                ->whereHas('getOrder', function ($query) {
                    $query->where('order_status', 'delivered');
                })
                ->whereDate('created_at', $selectedDate)
                ->sum(DB::raw('quantity * unit_price'));

                return view('homes.homeSeller', compact(
                    'stores', 
                    'total_orders',
                    'totalProductsSoldToday', 
                    'totalAmountGainedToday', 
                    'selectedDate', 
                    'user'  // Add the user to compact
                ));
                 break;
                case 3:
                    // Admin
                    return $this->homeAdmin();
                    break;
                default:
                    // Default to home view
                    return view('home', compact('user'));
                    break;
            }
        } else {
            return redirect()->route('login-page')->with('error', 'Please log in to access this page');
        }
    }

    public function homeAdmin() {
        $user = Auth::user();
        $total_users = User::where('email', '!=', 'admin2024@gmail.com')->count();
        $total_stores = Store::count();
        $total_orders = Order::count();
        $today = now()->format('Y-m-d');
        $today_new_users = User::whereDate('email_verified_at', $today)
                               ->where('email', '!=', 'admin2024@gmail.com')
                               ->get();
        $total_categories = Category::count();
        
        $today_orders = Order::whereDate('created_at', $today)->get();
    
        return view('homes.homeAdmin', compact('user'))
                    ->with('total_users', $total_users)
                    ->with('total_stores', $total_stores)
                    ->with('total_orders', $total_orders)
                    ->with('today_new_users', $today_new_users)
                    ->with('total_categories', $total_categories)
                    ->with('today_orders', $today_orders);
    }

    public function verifyEmail($user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            $user->email_verified_at = now();
            $user->save();
            Auth::login($user);
        } catch (\Exception $e) {
            Log::error("Error verifying email: {$e->getMessage()}");
        }
        return redirect()->route('set-profile');
    }

    //Seller dashboard details
    public function getDetails(Request $request)
    {
        try {
            $date = $request->query('date', now()->format('Y-m-d'));

            // Fetch orders based on the selected date
            $orders = Order::whereDate('created_at', $date)
                ->with('getOrderItem.getProduct.getStore') // Eager load the necessary relationships
                ->get();

            // Prepare data for the modal
            $sales = $orders->flatMap(function ($order) {
                return $order->getOrderItem->map(function ($item) {
                    return [
                        'product_name' => $item->getProduct->product_name,
                        'store_name' => $item->getProduct->getStore->store_name,
                        'price' => $item->unit_price * $item->quantity,
                    ];
                });
            });

            return response()->json(['sales' => $sales]);
        } catch (\Exception $e) {
            // Log the error and return a generic error response
            Log::error('Error fetching sales details: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch details'], 500);
        }
    }
    public function getOrderDetails(Request $request)
        {
            $date = $request->input('date');

            // Ensure the date is valid and format it as needed
            if (!$date) {
                return response()->json(['error' => 'Date is required'], 400);
            }

            // Query the orders based on the provided date
            $orders = Order::whereDate('created_at', $date)
                ->with(['getUser', 'getOrderItem.getProduct']) // Load related data
                ->get();

            $details = $orders->map(function ($order) {
                return [
                    'buyer_name' => $order->getUser->name,
                    'address' => $order->getUser->getProfile->address ?? 'N/A',
                    'product' => $order->getOrderItem->map(function ($item) {
                        return $item->getProduct->product_name; // Assuming a Product model with a name field
                    }),
                    'store_name' => $order->getOrderItem->first()->getProduct->getStore->store_name ?? 'N/A', // Assuming a Store model
                    'delivery_status' => $order->order_status // Adjust according to your Order model
                ];
            });

            return response()->json(['sales' => $details]);
        }

}
