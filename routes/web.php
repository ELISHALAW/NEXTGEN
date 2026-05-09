<?php

use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// --- Public Routes ---
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/shop', [AddToCartController::class, 'index'])->name('Shop.index');
Route::get('/promotion', [PromotionController::class, 'index'])->name('promotion.index');

// --- Guest Routes (Login/Register/Reset) ---
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

    // Password Reset Flow
    Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('auth.forgot-password');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');
    Route::post('/reset-password', [ForgotPasswordController::class, 'store'])->name('password.update');
});

// --- Authenticated Routes ---
Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // --- Email Verification Routes ---
    // 1. The Notice (The page you built)
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    // 2. The Handler (The link in the email)
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('home');
    })->middleware(['signed'])->name('verification.verify');

    // 3. The Resend Logic
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'verification-link-sent');
    })->middleware(['throttle:6,1'])->name('verification.send');

    // --- Verified-Only Routes ---
    // Any routes inside this group require the user to have clicked the email link
    Route::middleware('verified')->group(function () {

        // --- CART & CHECKOUT SYSTEM ---
        Route::prefix('cart')->name('cart.')->group(function () {
            Route::get('/', [AddToCartController::class, 'viewCart'])->name('index');
            Route::post('/add', [AddToCartController::class, 'store'])->name('add');
            Route::post('/remove', [AddToCartController::class, 'remove'])->name('remove');
        });

        Route::post('/checkout', [AddToCartController::class, 'checkout'])->name('checkout.store');

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

    // --- Other Authenticated Routes (Verification not strictly required) ---
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
});