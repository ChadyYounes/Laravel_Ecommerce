<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FacebookAuthController extends Controller
{
    public function redirect() {
        return Socialite::driver('facebook')->redirect();
    }

    public function callBackFacebook() {
        try {
            $facebook_user = Socialite::driver('facebook')->user();
            $user = User::where('facebook_id', $facebook_user->getId())->first();
    
            if (!$user) {
                // Create a new user if not exists
                $new_user = new User();
                $new_user->name = $facebook_user->getName();
                $new_user->email =  $facebook_user->getEmail();
                $new_user->microsoft_id = $facebook_user->getId();
                $new_user->save();
                $user = $new_user;
            }
    
            Auth::login($user);
    
            if ($user->role_id === null) {
                // Redirect the user to the setup page
                return redirect()->route('set-profile', ['user_id' => $user->id]);
            } else {
                // Redirect the user to their dashboard or homepage
                return redirect()->route('home');
            }
        } catch (\Throwable $e) {
            dd("Something went wrong " . $e->getMessage());
        }
    } 
}
