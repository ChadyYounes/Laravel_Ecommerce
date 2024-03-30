<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Verify;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
     
 
 // Display the email verification page
 public function showVerificationPage()
 {
    
     return view('auth.verify');
 }
}
