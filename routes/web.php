<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

// =========================================================================
// PUBLIC ROUTES
// =========================================================================
Route::get('/', fn() => view('welcome'))->name('home');

Route::get('/shop', [AddToCartController::class, 'index'])->name('shop.index');
Route::get('/promotion', [PromotionController::class, 'index'])->name('promotion.index');

// =========================================================================
// GUEST ROUTES
// =========================================================================
Route::middleware('guest')->group(function () {

    // Authentication
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

    // Password Reset
    Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])
        ->name('password.request');

    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])
        ->name('password.email');

    Route::get('/reset-password/{token}', fn($token) => 
        view('auth.reset-password', ['token' => $token])
    )->name('password.reset');

    Route::post('/reset-password', [ForgotPasswordController::class, 'store'])
        ->name('password.update');

    Route::post('/email/verification-notification', [App\Http\Controllers\Auth\EmailVerificationController::class, 'resend'])
    ->middleware('guest')           // ← Important
    ->name('verification.resend');
});

// =========================================================================
// AUTHENTICATED ROUTES
// =========================================================================
Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // =====================================================================
    // EMAIL VERIFICATION
    // =====================================================================
    Route::prefix('email')->name('verification.')->group(function () {

        Route::get('/verify', fn() => view('auth.verify-email'))
            ->name('notice');

        // Verify link from email
        Route::get('/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
            $request->fulfill();
            return redirect()->route('home')
                ->with('success', 'Your email has been successfully verified!');
        })->middleware('signed')->name('verify');

        // Resend verification link (supports your form with email input)
 
    });

    // =====================================================================
    // VERIFIED USERS ONLY
    // =====================================================================
    Route::middleware('verified')->group(function () {

        // Cart & Checkout
        Route::prefix('cart')->name('cart.')->group(function () {
            Route::get('/', [AddToCartController::class, 'viewCart'])->name('index');
            Route::post('/add', [AddToCartController::class, 'store'])->name('add');
            Route::post('/remove', [AddToCartController::class, 'remove'])->name('remove');
            Route::post('/checkout', [AddToCartController::class, 'checkout'])->name('checkout');
        });

        // Admin Panel
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
            Route::get('/users', [AdminController::class, 'index'])->name('users.index');

            // Resource Routes
            Route::resource('products', ProductController::class);
            Route::resource('orders', OrderController::class);
            Route::resource('users', AdminController::class)->except(['index']);
        });
    });

    // =====================================================================
    // OTHER AUTHENTICATED ROUTES (don't require email verification)
    // =====================================================================
    Route::get('/product/{product}', [ProductController::class, 'show'])
        ->name('product.show');
});