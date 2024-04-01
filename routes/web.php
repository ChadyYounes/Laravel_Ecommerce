<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\PagesControllers\HomeController;
use App\Http\Controllers\PagesControllers\SetProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\EmailVerificationController;


/********************************************************************* */
/********************************Amine Start*************************** */
Route::get('/', function () {
    return view('index');
});

/************************************************ */
Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/callback', [GoogleAuthController::class, 'callBackGoogle']);
/******************************************** */
// Route for handling the login attempt
Route::get('/login-page', [LoginController::class, 'loginView'])->name('login-page');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');;
Route::get('/login', [LoginController::class, 'loginView'])->name('login-page');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Forgot Password routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'forgotPasswordView_p1'])->name('forgotpassword-page1');
Route::get('/forgotpassword-enter-otp', [ForgotPasswordController::class, 'forgotPasswordEnterOtpView'])->name('forgotpassword-enter-otp');
Route::post('/send-reset-password-otp', [ForgotPasswordController::class, 'sendResetPasswordOtp'])->name('send-reset-password-otp');
Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('verify-otp');
Route::get('/reset-password/{id}', [ForgotPasswordController::class, 'showResetPasswordView'])->name('reset-password');

Route::post('/reset-new-password/{id}', [ForgotPasswordController::class, 'ResetNewPassword'])->name('reset-new-password');


// Route for handling the register method
Route::get('register', [RegisterController::class, 'registerView'])->name('register-page');
Route::post('store', [RegisterController::class, 'storeUser'])->name('store-user');
Route::get('/home', [HomeController::class, 'homeView'])->name('home')->middleware('auth');

// Route for handling the verify by email
Route::get('/verify-email', [EmailVerificationController::class, 'showVerificationPage'])->name('email.verify');
Route::get('/verify-email/{user_id}', [HomeController::class, 'verifyEmail'])->name('user.verify');
//Set Profile
Route::get('/set-profile/{user_id}', [SetProfileController::class, 'setProfileView'])->name('set-profile');
Route::post('/save-profile/{user_id}', [SetProfileController::class, 'saveProfile'])->name('save-profile');

/****************************Amine End******************************** */
/******************************************************************** */

//kassem
//chat form route
Route::get('/chatsList',[ChatController::class,'chatsList'])->name('chats_list');
Route::get('/chatsList/{id}',[ChatController::class,'chatForm'])->name('chat_form');
