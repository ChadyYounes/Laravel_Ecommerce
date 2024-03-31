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
        return view('home');
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

    return redirect()->route('set-profile', ['user_id' => $user_id]);
}
}
