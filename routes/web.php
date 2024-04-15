<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Currency\CurrencyController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\FacebookAuthController;
use App\Http\Controllers\PagesControllers\HomeController;
use App\Http\Controllers\PagesControllers\SetProfileController;
use App\Http\Controllers\PagesControllers\EditProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Admin\AdminController;

/********************************************************************* */
/********************************Amine Start*************************** */
Route::get('/', function () {
    return view('index');
});

/************************************************ */
//Socialite Controllers
Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/callback', [GoogleAuthController::class, 'callBackGoogle']);
Route::get('auth/facebook', [FacebookAuthController::class, 'redirect'])->name('facebook-auth');
Route::get('auth/facebook/callback', [FacebookAuthController::class, 'callBackFacebook']);
/******************************************** */
// Route for handling the login attempt and logout
//Route::get('/login-page', [LoginController::class, 'loginView'])->name('login-page');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::get('/login', [LoginController::class, 'loginView'])->name('login-page');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Forgot Password Controller
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
Route::get('/home', [HomeController::class, 'homeView'])->name('home')->middleware('auth')->middleware('checkUserStatus');

// Route for handling the verify by email
Route::get('/verify-email', [EmailVerificationController::class, 'showVerificationPage'])->name('email.verify');
Route::get('/verify-email/{user_id}', [HomeController::class, 'verifyEmail'])->name('user.verify');

//Set Profile Controller
Route::get('/set-profile', [SetProfileController::class, 'setProfileView'])->name('set-profile')->middleware('auth');

Route::post('/save-profile', [SetProfileController::class, 'saveProfile'])->name('save-profile');

//Edit Profile Controller
Route::get('/edit-profile', [EditProfileController::class, 'editProfileView'])->name('edit-profile');
Route::post('/save-profile-edited/{user_id}', [EditProfileController::class, 'saveProfile'])->name('save-profile-edited');
Route::post('/delete-account/{user_id}', [EditProfileController::class, 'deleteAccount'])->name('delete-account');

//Admin Controller
Route::get('/admin/orders', [AdminController::class, 'admin_orders_view'])->name('admin.orders');
Route::get('/admin/users', [AdminController::class, 'admin_users_view'])->name('admin.users');
Route::get('/admin/stores', [AdminController::class, 'admin_stores_view'])->name('admin.stores');
Route::put('/user/{userId}/updateStatus',[AdminController::class, 'updateUserStatus'])->name('user.updateStatus');
Route::put('/store/{storeId}/updateStatus',[AdminController::class, 'updateStoreStatus'])->name('store.updateStatus');
Route::get('/user/deactivated',[AdminController::class, 'user_deactivated_view'])->name('user.deactivated');
Route::get('/user/info/{user_id}',[AdminController::class, 'user_info_view'])->name('user.info');
Route::get('/store/info/{store_id}',[AdminController::class, 'store_info_view'])->name('store.info');
Route::post('/save-profile-edited-by-admin/{user_id}', [AdminController::class, 'saveProfileByAdmin'])->name('save-profile-edited-by-admin');
Route::post('/delete-user-account/{user_id}', [AdminController::class, 'deleteUserAccountByAdmin'])->name('delete-user-account-by-admin');
Route::put('/update-store-by-admin/{store_id}', [AdminController::class, 'updateStoreByAdmin'])->name('update-store-by-admin');
Route::post('/delete-store-by-admin/{store_id}', [AdminController::class, 'deleteStoreByAdmin'])->name('delete-store-by-admin');
/****************************Amine End******************************** */
/******************************************************************** */

//kassem
//chat form route
Route::get('/chatsList',[ChatController::class,'chatsList'])->name('chats_list');
Route::get('/chatsList/{id}',[ChatController::class,'chatForm'])->name('chat_form');
Route::post('/send-message/{receiver_id}', [ChatController::class, 'sendMessage'])->name('sendMessage');
Route::post('/update-base-currency',[CurrencyController::class,'changeBaseCurrency'])->name('update-base-currency');

//chady
//stores routes
Route::get('/addStore/{user_id}',[StoreController::class,'storeForm'])->name('storeFormView');
Route::post('/addStore/{user_id}',[StoreController::class,'createStore'])->name('createStore');

Route::get('/viewStore/{user_id}',[StoreController::class,'storeView'])->name('storeView');
//store delete
Route::delete('/viewStore/{store_id}',[StoreController::class,'deleteStore'])->name('deleteStore');
//store edit
Route::get('/editStore/{store_id}/{user_id}',[StoreController::class,'updateView'])->name('updateView');
Route::put('editStore/{store_id}/{user_id}',[StoreController::class,'updateStore'])->name('updateStore');
//products view route
Route::get('/productsView/{store_id}',[ProductController::class,'productView'])->name('productsView');





