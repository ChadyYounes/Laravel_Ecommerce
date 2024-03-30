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

    
    public function verifyEmail($user_id)
{
    try {
        // Find the user by user_id
        $user = User::findOrFail($user_id);
        
        // Update the email_verified_at field
        $user->email_verified_at = now();
        $user->save();
    } catch (\Exception $e) {
        // Log or handle any database-related exceptions
        Log::error("Error verifying email: {$e->getMessage()}");
    }

    // Redirect the user to the home page
    return redirect()->route('home');
}
}
