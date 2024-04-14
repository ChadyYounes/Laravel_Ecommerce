<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
class FacebookAuthController extends Controller
{
    public function redirect()
            {
                return Socialite::driver('facebook')->redirect();
            }

    public function callBackFacebook()
        {
            try {
                $facebookUser = Socialite::driver('facebook')->user();
                $user = User::where('email', $facebookUser->getEmail())->first();
            
                if (!$user) {
                    $user = new User();
                    $user->name = $facebookUser->getName();
                    $user->email = $facebookUser->getEmail();
                    $user->facebook_id = Hash::make($facebookUser->getId()); 
                    $user->save();
                }
            
                Auth::login($user);
            
                if ($user->role_id === null) {
                    return redirect()->route('set-profile');
                } else {
                    return redirect()->route('home');
                }
            } catch (\Throwable $e) {
                Log::error("Error: " . $e->getMessage() . " on line " . $e->getLine() . " in file " . $e->getFile());
                dd("Error: " . $e->getMessage() . " on line " . $e->getLine() . " in file " . $e->getFile());
            }
        }
}