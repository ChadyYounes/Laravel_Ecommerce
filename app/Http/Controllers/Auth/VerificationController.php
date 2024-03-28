<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
class VerificationController extends Controller
{
    public function showVerificationNotice()
{
    return view('auth.verify');
}

public function verify(EmailVerificationRequest $request)
{
    if ($request->user()->hasVerifiedEmail()) {
        return redirect()->route('home');
    }

    $request->user()->markEmailAsVerified();

    return redirect()->route('home')->with('verified', true);
}
}
