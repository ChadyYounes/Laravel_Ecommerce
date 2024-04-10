<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callBackGoogle()
{
    try {
        $googleUser = Socialite::driver('google')->user();
        $user = User::where('email', $googleUser->getEmail())->first();
    
        if (!$user) {
            // Create a new user if not exists
            $user = new User();
            $user->name = $googleUser->getName();
            $user->email = $googleUser->getEmail();
            $user->google_id = Hash::make($googleUser->getId()); // Store the hashed Google ID
            $user->save();
        }
    
        Auth::login($user);
    
        if ($user->role_id === null) {
            // Redirect the user to the setup page
            return redirect()->route('set-profile');
        } else {
            // Redirect the user to their dashboard or homepage
            return redirect()->route('home');
        }
    } catch (\Throwable $e) {
        dd("Error: " . $e->getMessage() . " on line " . $e->getLine() . " in file " . $e->getFile());
    }
}

}