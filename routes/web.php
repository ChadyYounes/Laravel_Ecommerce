<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\PagesControllers\HomeController;
use App\Http\Controllers\PagesControllers\SetProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerificationController;
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
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Route for handling the register method
Route::get('register', [RegisterController::class, 'registerView'])->name('register-page');
Route::post('store', [RegisterController::class, 'storeUser'])->name('store-user');
//Route::post('/home', [HomeController::class, 'homeView'])->name('home');
Route::get('/home', [HomeController::class, 'homeView'])->name('home');

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
Route::get('/chat',[ChatController::class,'chatForm'])->name('chat_form')->middleware('auth');
