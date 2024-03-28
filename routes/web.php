<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\PagesControllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerificationController;

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
Route::get('/login', [LoginController::class, 'loginView'])->name('login-page');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Route for handling the register method
Route::get('register', [RegisterController::class, 'registerView'])->name('register-page');
Route::post('store', [RegisterController::class, 'storeUser'])->name('store-user');
//Route::post('/home', [HomeController::class, 'homeView'])->name('home');
Route::get('/home', [HomeController::class, 'homeView'])->name('home');

// Route for handling the verify by email
Route::get('/verify', [VerificationController::class, 'showVerificationNotice'])->name('verification.notice');
Route::get('/verify-email', [VerificationController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');

/****************************Amine End******************************** */
/******************************************************************** */