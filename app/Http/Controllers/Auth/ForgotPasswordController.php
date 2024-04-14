<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordOtp;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ForgotPasswordController extends Controller
{
    public function forgotPasswordView_p1()
    {
        return view('auth.forgotPasswordP1');
    }

    public function forgotPasswordEnterOtpView()
    {
        return view('auth.forgotPasswordEnterOtp');
    }

    public function sendResetPasswordOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // User not found, return an error message
            return redirect()->route('forgotpassword-page1')->with('error', 'User not found.');
        }

        // Set the user email in the session
        $request->session()->put('reset_password_email', $user->email);

        // 5-digit OTP code
        $otp = rand(10000, 99999);
        Mail::to($user->email)->send(new ResetPasswordOtp($otp));
        $request->session()->put('reset_password_otp', $otp);

        return redirect()->route('forgotpassword-enter-otp');
    }

    public function verifyOtp(Request $request)
    {
        $enteredOtp = $request->first_digit . $request->second_digit . $request->third_digit . $request->fourth_digit . $request->fifth_digit;

        $storedOtp = session('reset_password_otp');

        if ($enteredOtp == $storedOtp) {
            return redirect()->route('reset-password');
        } else {
            return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
        }
    }

    public function showResetPasswordView(Request $request)
    {
        $email = $request->session()->get('reset_password_email');
        if (!$email) {
            return redirect()->route('forgotpassword-page1')->with('error', 'Email not provided.');
        }

        return view('auth.resetNewPassword', ['email' => $email]);
    }

    public function ResetNewPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8|same:new_password',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        Auth::logout();

        return redirect()->route('login-page')->with('success', 'Your password has been successfully updated. Please login with your new password.');
    }
}
