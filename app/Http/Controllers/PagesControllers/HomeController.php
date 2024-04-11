<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Store;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function homeView() {
        // Retrieve the authenticated user
        $user = Auth::user();
        
        // Check if the user is authenticated
        if ($user) {
            // Check the role_id of the user
            switch ($user->role_id) {
                case 1:
                    // Buyer
                    return view('homes.homeBuyer', compact('user'));
                    break;
                case 2:
                    // Seller
                    return view('homes.homeSeller', compact('user'));
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
            // Redirect to login if user is not authenticated
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


        return view('homes.homeAdmin', compact('user'))
                    ->with('total_users', $total_users)
                    ->with('total_stores', $total_stores)
                    ->with('total_orders', $total_orders)
                    ->with('today_new_users', $today_new_users);
    }
    
    public function verifyEmail($user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            $user->email_verified_at = now();
            $user->save();
            // Authenticate the user
            Auth::login($user);
        } catch (\Exception $e) {
            Log::error("Error verifying email: {$e->getMessage()}");
        }
        return redirect()->route('set-profile');
    }
}
