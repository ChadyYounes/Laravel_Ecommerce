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
    public function forgotPasswordView_p1() {

        return view('auth.forgotPasswordP1');
    }
    public function forgotPasswordEnterOtpView() {

        return view('auth.forgotPasswordEnterOtp');
    }
    public function showResetPasswordView($id)
            {
                $user = User::find($id);
                if (!$user) {
                    return redirect()->back()->with('error', 'User not found.');
                }

                return view('auth.resetNewPassword', ['id' => $id, 'email' => $user->email]);
            }

    
     public function sendResetPasswordOtp(Request $request)
            {
                $request->validate([
                    'email' => 'required|email|exists:users,email',
                ]);
            
                $user = User::where('email', $request->email)->first();
            
                if (!$user) {
                    // User not found, return an error message
                    return response()->json(['message' => 'User not found'], 404);
                }
            
                // Set the user ID in the session
                $request->session()->put('reset_password_user_id', $user->id);
            
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
                $userId = session('reset_password_user_id');

                if ($enteredOtp == $storedOtp) {
                    // Pass the user ID to the reset password view
                    return redirect()->route('reset-password', ['id' => $userId]);
                } else {
                    return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
                }
            }

  
    public function ResetNewPassword(Request $request, $id)
            {
                // Validate the form data
                $request->validate([
                    'new_password' => 'required|string|min:8',
                    'confirm_password' => 'required|string|min:8|same:new_password',
                ]);

                // Find the user by ID
                $user = User::find($id);

                // Check if user exists
                if (!$user) {
                    return redirect()->back()->with('error', 'User not found.');
                }

                // Update the user's password
                $user->password = Hash::make($request->new_password);
                $user->save();

                
                Auth::logout();

                // Redirect the user to the login page with a success message
                return redirect()->route('login-page')->with('success', 'Your password has been successfully updated. Please login with your new password.');
            }

}
