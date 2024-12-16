<?php

use App\Http\Controllers\ECommerce\Home\HomeController;
use App\Http\Controllers\Website\WebController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Website Routes
Route::get('/', [WebController::class,"index"])->name("website.home");
Route::get('/about-us', [WebController::class,"about"])->name("website.about-us");
Route::get('/contact-us', [WebController::class,"contact"])->name("website.contact-us");
Route::post('/contact-us', [WebController::class,"contactStore"])->name("website.contact-us");
Route::get('/faq', [WebController::class,"faq"])->name("website.faqs");
Route::get('/privacy', [WebController::class,"privacy"])->name("website.privacy");
Route::get('/terms', [WebController::class,"terms"])->name("website.terms");
Route::get('/suspend', function(){
    return view('errors.suspend');
})->name("suspend");
Route::get('/not_completed', function(){
    return view("errors.not_completed");
})->name("not_completed");

// E-Commerce Routes

Route::prefix('/{domain}')->name("e-commerce.")->middleware("is_open")->group(function(){
    // Home
    Route::get('/', [\App\Http\Controllers\ECommerce\Home\HomeController::class,"index"])->name("home");
    // About
    Route::get('/about', [\App\Http\Controllers\ECommerce\About\AboutController::class,"index"])->name("about");
    // Contact
    Route::resource('/contact', \App\Http\Controllers\ECommerce\Contact\ContactController::class)->only(["index","store"]);
    // Terms
    Route::get('/terms', [\App\Http\Controllers\ECommerce\Terms\TermsController::class,"index"])->name("terms");

    // Auth
    Route::get('login', [\App\Http\Controllers\ECommerce\Auth\LoginController::class,"index"])->name("login");
    Route::post('login', [\App\Http\Controllers\ECommerce\Auth\LoginController::class,"store"])->name("login.store");
    Route::resource('register', \App\Http\Controllers\ECommerce\Auth\RegisterController::class)->only(["index","store"]);
    Route::resource('otp', \App\Http\Controllers\ECommerce\Auth\OTPController::class)->only(["index","store"]);
    Route::resource('forget-password', \App\Http\Controllers\ECommerce\Auth\ForgetPasswordController::class)->only(["index","store"]);
    Route::resource('reset-password', \App\Http\Controllers\ECommerce\Auth\ResetPasswordController::class)->only(["index","store"]);
    Route::post('re-send', [\App\Http\Controllers\ECommerce\Auth\ResetPasswordController::class,"reSend"])->name('re-send');

    // Product
    Route::resource('products', \App\Http\Controllers\ECommerce\Products\ProductsController::class)->only(["index","show"]);
    Route::post('products/{product}/comment', [\App\Http\Controllers\ECommerce\Products\ProductsController::class,"commentStore"])->where("product","[0-9]+")->name("products.comments.store")->middleware("auth");

    Route::middleware("auth")->group(function(){
        // LogOut
        Route::get('profile/logout', [\App\Http\Controllers\ECommerce\Profile\ProfileController::class,"logout"])->name("profile.logout");

        // Profile
        Route::resource('/profile', \App\Http\Controllers\ECommerce\Profile\ProfileController::class)->only(["index","store"]);
        // Change Password
        Route::resource('profile/change-password', \App\Http\Controllers\ECommerce\Profile\ChangePasswordController::class)->only(["store"]);
        // Address
        Route::resource('profile/address', \App\Http\Controllers\ECommerce\Profile\AddressController::class)->only(["store"]);
        Route::get('profile/address/{address}/delete', [\App\Http\Controllers\ECommerce\Profile\AddressController::class,"destroy"])->name("profile.address.destroy")->where('address',"[0-9]+");
        // Notifications
        Route::get('profile/notifications/{notification}/delete', [\App\Http\Controllers\ECommerce\Profile\NotificationsController::class,"destroy"])->name("profile.notifications.destroy")->where("notification","[0-9]+");
        // Orders
        Route::resource('profile/orders', \App\Http\Controllers\ECommerce\Profile\OrdersController::class)->only(["show"]);
        Route::get('profile/orders/{order}/tracking', [\App\Http\Controllers\ECommerce\Profile\OrdersController::class,"showPolicy"])->name("orders.tracking")->where('order',"[0-9]+");
        // favorites
        Route::resource('profile/favorites', \App\Http\Controllers\ECommerce\Profile\FavoritesController::class)->only(["index","destroy"]);
        // Cart
        Route::get('cart', [\App\Http\Controllers\ECommerce\Carts\CartsController::class,"index"])->name("cart.index");
        Route::get('cart/{product}/delete', [\App\Http\Controllers\ECommerce\Carts\CartsController::class,"ajaxDeleteCart"])->name("cart.delete")->where("product","[0-9]+");
        Route::post('cart/{product}/addOrRemoveQty', [\App\Http\Controllers\ECommerce\Carts\CartsController::class,"addOrRemoveQty"])->name("cart.addOrRemoveQty")->where("product","[0-9]+");
        Route::post('cart', [\App\Http\Controllers\ECommerce\Carts\CartsController::class,"ajaxUpdateCart"])->name("cart.update");
        // CheckOut
        Route::get('check-out', [\App\Http\Controllers\ECommerce\CheckOut\CheckOutController::class,"index"])->name("check-out.index");
        Route::post('check-out', [\App\Http\Controllers\ECommerce\CheckOut\CheckOutController::class,"store"])->name("check-out.store");
        Route::get('check-out/completed', [\App\Http\Controllers\ECommerce\CheckOut\CheckOutController::class,"orderCompleted"])->name("check-out.orderCompleted");
    });

    Route::get('/payment/call-back',[\App\Http\Controllers\ECommerce\CheckOut\CheckOutController::class,"callBackPlans"])->name('payment-call-back');

    Route::get("action/{action_name}/{product_id}",[\App\Http\Controllers\ECommerce\Products\ProductsController::class,"action"]);


});
