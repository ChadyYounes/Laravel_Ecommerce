<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
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
                    return view('homeBuyer', compact('user'));
                    break;
                case 2:
                    // Seller
                    return view('homeSeller', compact('user'));
                    break;
                case 3:
                    // Admin
                    return view('homeAdmin', compact('user'));
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
