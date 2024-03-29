<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Verify;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
     
 
     // Send verification email
     public function sendVerificationEmail(Request $request)
 {
     // Validate the email input
     $request->validate([
         'email' => 'required|email|unique:users',
     ]);
 
     // Create a new user instance
     $user = new User();
     $user->email = $request->email;
     // Save the user record
     $user->save();
 
     // Generate the verification URL with user ID
     $verificationUrl = route('user.verify', ['user' => $user->id]);
 
     // Send the verification email with the $user variable
     Mail::to($request->email)->send(new Verify($verificationUrl, $user));
 
     // Redirect to the email verification page
     return redirect()->route('email.verify');
 }
 
 
 // Display the email verification page
 public function showVerificationPage()
 {
     // Generate the verification URL without relying on the authenticated user
     // You may need to adjust this logic based on how users are identified in your application
     $verificationUrl = route('email.verify');
 
     // Pass the verification URL to the view
     return view('auth.verify', ['verificationUrl' => $verificationUrl]);
 }
}
