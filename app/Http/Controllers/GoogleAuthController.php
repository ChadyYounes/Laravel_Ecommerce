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

            if(!$user) {
                // $new_user = User::create([
                //     'name'=> $google_user->getName(),
                //     'email'=> $google_user->getEmail(),
                //     'google_id'=> $google_user->getId(), 
                // ]);
                $new_user = new User();
                $new_user->name = $google_user->getName();
                $new_user->email =  $google_user->getEmail();
                $new_user->google_id =$google_user->getId();
                $new_user->save();

                Auth::login($new_user);

                //return redirect()->intended('dashboard');
                return view('home');
            }
            else {
                Auth::login($user);

                //return redirect()->intended('dashboard');
                return view('home');
            }
        } catch(\Throwable $e) {
            dd("Something went wrong " . $e->getMessage());
        }
    }
}
