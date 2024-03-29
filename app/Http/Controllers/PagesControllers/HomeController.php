<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Carbon;
class HomeController extends Controller
{
    public function homeView() {
        return view('home');
    }

    public function verifyEmail(Request $request)
    {
        try {
            // Retrieve the user by email
            $user = User::where('email', $request->email)->first();
            //$user->update(['email_verified_at' => Carbon::now()->timestamp]);
            
            // Check if the user exists
            if ($user) {
                // Update the email_verified_at field
                $user->email_verified_at = now();
                $user->save();
            } else {
                // Log or handle the case when the user is not found
                // This could indicate an issue with the request data or database query
                Log::warning("User with email {$request->email} not found.");
            }
        } catch (\Exception $e) {
            // Log or handle any database-related exceptions
            Log::error("Error verifying email: {$e->getMessage()}");
        }
    
        // Redirect the user to the home page
        return redirect()->route('home');
    }
    
}
