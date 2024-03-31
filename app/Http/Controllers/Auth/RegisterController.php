<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Mail\Verify;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function registerView() {
        return view('auth.register');
    }

    public function storeUser(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'createPassword' => 'required|string|min:8',
            'confirmPassword' => 'required|same:createPassword', 
        ], [
            'email.unique' => 'The email address has already been taken.', 
            'confirmPassword.same' => 'The password confirmation does not match.', 
        ]);
    
        $new_user = new User();
        $new_user->name = $validatedData['username'];
        $new_user->email = $validatedData['email'];
        $new_user->password = Hash::make($validatedData['createPassword']);
        
        $new_user->save();
        
        

    // Generate the verification URL with user id
    $verificationUrl = route('user.verify', ['user_id' => $new_user->id]);
 
    // Send the verification email with the $user variable
    Mail::to($request->email)->send(new Verify($verificationUrl, $new_user));

    // Redirect to the email verification page
    return redirect()->route('email.verify');
        
    }
    
    
}
