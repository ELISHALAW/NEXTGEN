<?php

use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
// --- Public Routes ---
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Standardized to lowercase 'shop.index' for consistency across your app
Route::get('/shop', [AddToCartController::class, 'index'])->name('Shop.index');
Route::get('/promotion', [PromotionController::class, 'index'])->name('promotion.index');

// --- Guest Routes (Login/Register) ---
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    // Forgot Password
    Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])
        ->middleware('guest')
        ->name('password.request');

    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])
        ->middleware('guest')
        ->name('password.email');

    // Reset Password
    // Update this line in web.php
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');

    Route::post('/reset-password', [ForgotPasswordController::class, 'store'])->name('password.update');
    // The page that shows the form
    Route::get('/email/verify-request', [VerificationController::class, 'showRequestForm'])
        ->name('verification.request');

    // The action that sends the email
    Route::post('/email/verification-notification', [VerificationController::class, 'sendLink'])
        ->middleware(['throttle:6,1']) // Prevent spam
        ->name('verification.send');

        // From your web.php
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    // Redirect back to the verification page with a success message
    return redirect()->route('verification.request')->with('status', 'Your email has been verified successfully!');
})->middleware(['auth', 'signed'])->name('verification.verify');

// --- Authenticated Routes ---
Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // --- CART & CHECKOUT SYSTEM ---
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [AddToCartController::class, 'viewCart'])->name('index');
        Route::post('/add', [AddToCartController::class, 'store'])->name('add');
        Route::post('/remove', [AddToCartController::class, 'remove'])->name('remove'); // Added for the trash icon
    });

    // Finalizing the Order
    Route::post('/checkout', [AddToCartController::class, 'checkout'])->name('checkout.store'); // Added for the Place Order button

    // --- Product Details ---
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

    // --- Admin Protected Routes ---
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [AdminController::class, 'index'])->name('users.index');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users/create', [AdminController::class, 'create'])->name('users.create');
        Route::post('/users/store', [AdminController::class, 'store'])->name('users.store');
        Route::resource('products', ProductController::class);
        Route::resource('orders', OrderController::class);
        Route::resource('users', AdminController::class)->except(['index']);
    });
});
