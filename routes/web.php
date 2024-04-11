<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\FacebookAuthController;
use App\Http\Controllers\PagesControllers\HomeController;
use App\Http\Controllers\PagesControllers\SetProfileController;
use App\Http\Controllers\PagesControllers\EditProfileController;
use App\Http\Controllers\StoreController;
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
Route::get('auth/facebook', [FacebookAuthController::class, 'redirect'])->name('facebook-auth');
Route::get('auth/facebook/callback', [FacebookAuthController::class, 'callBackFacebook']);
/******************************************** */
// Route for handling the login attempt
Route::get('/login-page', [LoginController::class, 'loginView'])->name('login-page');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');;
Route::get('/login', [LoginController::class, 'loginView'])->name('login-page');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Forgot Password routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'forgotPasswordView_p1'])->name('forgotpassword-page1');
Route::get('/forgotpassword-enter-otp', [ForgotPasswordController::class, 'forgotPasswordEnterOtpView'])
->name('forgotpassword-enter-otp');
Route::post('/send-reset-password-otp', [ForgotPasswordController::class, 'sendResetPasswordOtp'])
->name('send-reset-password-otp');
Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('verify-otp');
Route::get('/reset-password', [ForgotPasswordController::class, 'showResetPasswordView'])->name('reset-password');
Route::post('/reset-new-password', [ForgotPasswordController::class, 'ResetNewPassword'])->name('reset-new-password');


// Route for handling the register method
Route::get('register', [RegisterController::class, 'registerView'])->name('register-page');
Route::post('store', [RegisterController::class, 'storeUser'])->name('store-user');
Route::get('/home', [HomeController::class, 'homeView'])->name('home')->middleware('auth');
    
// Route for handling the verify by email
Route::get('/verify-email', [EmailVerificationController::class, 'showVerificationPage'])->name('email.verify');
Route::get('/verify-email/{user_id}', [HomeController::class, 'verifyEmail'])->name('user.verify');

//Set Profile
Route::get('/set-profile', [SetProfileController::class, 'setProfileView'])->name('set-profile')->middleware('auth');

Route::post('/save-profile', [SetProfileController::class, 'saveProfile'])->name('save-profile');

//Edit Profile
Route::get('/edit-profile', [EditProfileController::class, 'editProfileView'])->name('edit-profile');
Route::post('/save-profile-edited/{user_id}', [EditProfileController::class, 'saveProfile'])->name('save-profile-edited');
Route::post('/delete-account/{user_id}', [EditProfileController::class, 'deleteAccount'])->name('delete-account');
/****************************Amine End******************************** */
/******************************************************************** */

//kassem
//chat form route
Route::get('/chatsList',[ChatController::class,'chatsList'])->name('chats_list');
Route::get('/chatsList/{id}',[ChatController::class,'chatForm'])->name('chat_form');
Route::post('/send-message/{receiver_id}', [ChatController::class, 'sendMessage'])->name('sendMessage');


//chady
//stores routes
Route::get('/addStore/{user_id}',[StoreController::class,'storeForm'])->name('storeFormView');
Route::post('/addStore/{user_id}',[StoreController::class,'createStore'])->name('createStore');

Route::get('/viewStore/{user_id}',[StoreController::class,'storeView'])->name('storeView');






