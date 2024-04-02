<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class GoogleAuthController extends Controller
{
    public function redirect() {
        return Socialite::driver('google')->redirect();
    }
    public function callBackGoogle() {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = User::where('google_id', $google_user->getId())->first();
    
            if (!$user) {
                // Create a new user if not exists
                $new_user = new User();
                $new_user->name = $google_user->getName();
                $new_user->email =  $google_user->getEmail();
                $new_user->google_id = $google_user->getId();
                $new_user->save();
                $user = $new_user;
            }
    
            Auth::login($user);
    
            if ($user->role_id === null) {
                // Redirect the user to the setup page
                return redirect()->route('set-profile', ['user_id' => $user->id]);
            } else {
                // Redirect the user to their dashboard or homepage
                return redirect()->route('home', ['user_id' => $user->id]);
            }
        } catch (\Throwable $e) {
            dd("Something went wrong " . $e->getMessage());
        }
    }
}
