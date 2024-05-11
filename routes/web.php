<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Currency\CurrencyController;
use App\Http\Controllers\EventController;
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
use App\Http\Controllers\StripeController;
/********************************************************************* */
/********************************Amine Start*************************** */
/************************************************ */
//Socialite Controllers
Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/callback', [GoogleAuthController::class, 'callBackGoogle']);
Route::get('auth/facebook', [FacebookAuthController::class, 'redirect'])->name('facebook-auth');
Route::get('auth/facebook/callback', [FacebookAuthController::class, 'callBackFacebook']);
/******************************************** */
// Route for handling the login attempt and logout
Route::get('/', [LoginController::class, 'loginView'])->name('login-page');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
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
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/orders', [AdminController::class, 'admin_orders_view'])->name('admin.orders');
    Route::get('/admin/users', [AdminController::class, 'admin_users_view'])->name('admin.users');
    Route::get('/admin/stores', [AdminController::class, 'admin_stores_view'])->name('admin.stores');
    Route::get('/admin/categories', [AdminController::class, 'admin_categories_view'])->name('admin.categories');
    Route::post('/category/add', [AdminController::class,'addCategory'])->name('category.addCategory');
    Route::post('/delete-category-by-admin/{category_id}', [AdminController::class, 'deleteCategoryByAdmin'])->name('category.deleteCategory');
    Route::put('/user/{userId}/updateStatus',[AdminController::class, 'updateUserStatus'])->name('user.updateStatus');
    Route::put('/store/{storeId}/updateStatus',[AdminController::class, 'updateStoreStatus'])->name('store.updateStatus');
    Route::get('/user/deactivated',[AdminController::class, 'user_deactivated_view'])->name('user.deactivated');
    Route::get('/user/info/{user_id}',[AdminController::class, 'user_info_view'])->name('user.info');
    Route::get('/store/info/{store_id}',[AdminController::class, 'store_info_view'])->name('store.info');
    Route::post('/save-profile-edited-by-admin/{user_id}', [AdminController::class, 'saveProfileByAdmin'])->name('save-profile-edited-by-admin');
    Route::post('/changeOrderStatus/{order_id}', [AdminController::class, 'changeOrderStatus'])->name('changeOrderStatus');
    Route::post('/delete-user-account/{user_id}', [AdminController::class, 'deleteUserAccountByAdmin'])->name('delete-user-account-by-admin');
    Route::put('/update-store-by-admin/{store_id}', [AdminController::class, 'updateStoreByAdmin'])->name('update-store-by-admin');
    Route::post('/delete-store-by-admin/{store_id}', [AdminController::class, 'deleteStoreByAdmin'])->name('delete-store-by-admin');
    Route::get('/admin/search', [AdminController::class, 'super_search_view'])->name('admin.super_search_view');
    Route::get('admin/stores/deactivated', [AdminController::class,'admin_stores_deactivated_view'])->name('admin.stores.deactivated');
Route::get('admin/stores/activated', [AdminController::class,'admin_stores_activated_view'])->name('admin.stores.activated');
});



/****************************Amine End******************************** */

/****************** Payment Checkout*************************** */
Route::get('buyer/shoppingCart', [StripeController::class,'shoppingCart'])->name('shoppingCart');
Route::delete('/delete-cart-item', [StripeController::class,'deleteCartItem'])->name('deleteCartItem');
Route::patch('/update-cart-item', [StripeController::class,'updateCartItem'])->name('updateCartItem');
Route::get('buyer/shoppingCart/delivery-address', [StripeController::class,'deliveryAddress'])->name('deliveryAddress');

Route::post('/session-stripe', [StripeController::class, 'session'])->name('session-stripe');
Route::get('/success', [StripeController::class,'success'])->name('success');
/******************************************************************** */

//kassem
//chat form route
Route::get('/chatsList',[ChatController::class,'chatsList'])->name('chats_list');
Route::get('/chatsList/{id}',[ChatController::class,'chatForm'])->name('chat_form');
Route::post('/send-message/{receiver_id}', [ChatController::class, 'sendMessage'])->name('sendMessage');
Route::post('/update-base-currency',[CurrencyController::class,'changeBaseCurrency'])->name('update-base-currency');
Route::post('/storeEvent',[EventController::class,'storeEvent'])->name('storeEvent');
Route::get('/buyer/viewEvents',[BuyerController::class,'viewEvents'])->name('viewEvents');
Route::get('/buyer/myEvents',[BuyerController::class,'myEvents'])->name('myEvents');
Route::post('/subscribeToEvent',[BuyerController::class,'subscribeToEvent'])->name('subscribeToEvent');
Route::post('/unsubscribeFromEvent',[BuyerController::class,'unsubscribeFromEvent'])->name('unsubscribeFromEvent');
Route::get('/liveBidding/{id}',[BuyerController::class,'liveBidding'])->name('liveBidding');
Route::post('/placeBid',[BidController::class,'placeBid'])->name('placeBid');
Route::post('/followStore',[BuyerController::class,'followStore'])->name('followStore');
Route::post('/unfollowStore',[BuyerController::class,'unfollowStore'])->name('unfollowStore');
//chady
//stores routes
Route::get('/addStore/{user_id}',[StoreController::class,'storeForm'])->name('storeFormView');
Route::post('/addStore/{user_id}',[StoreController::class,'createStore'])->name('createStore');

Route::get('/viewStore/{user_id}',[StoreController::class,'storeView'])->name('storeView');
Route::get('/viewStore/Report/{user_id}',[StoreController::class,'SellerReportsView'])->name('SellerReports');

Route::post('/filter-orders', [StoreController::class, 'filterOrders'])->name('filterOrders');
//store delete
Route::delete('/viewStore/{store_id}',[StoreController::class,'deleteStore'])->name('deleteStore');
//store edit
Route::get('/editStore/{store_id}/{user_id}',[StoreController::class,'updateView'])->name('updateView');
Route::put('editStore/{store_id}/{user_id}',[StoreController::class,'updateStore'])->name('updateStore');

//products view route
Route::get('/productsView/{store_id}',[ProductController::class,'productView'])->name('productsView');
Route::get('/addproductsView/{store_id}',[ProductController::class,'addProductView'])->name('addProductView');
Route::post('/product/{product_id}/delete',[ProductController::class,'deleteProduct'])->name('deleteProduct');
Route::post('/addproductsView/{store_id}',[ProductController::class,'createProduct'])->name('addProduct');
Route::get('/products/{product_id}/edit', [ProductController::class, 'editProductView'])->name('editProductView');
Route::post('/products/{product_id}/edit', [ProductController::class, 'editProduct'])->name('editProduct');

//buyer Stores view
route::get('/buyer/stores',[BuyerController::class,'buyerLayout'])->name('buyerStores');
route::get('/buyer/store/{id}/product',[BuyerController::class,'storeProductView'])->name('storeProductView');

//add to shopping cart
Route::post('/add-to-cart', [CartController::class,'addToCart'])->name('addToCart');
Route::get('/search/{store_id}', [BuyerController::class,'search_category'])->name('search');
Route::get('/sort/{store_id}', [BuyerController::class, 'sort'])->name('sort');





