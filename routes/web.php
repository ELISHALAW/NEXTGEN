<?php

use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionController;
use Illuminate\Support\Facades\Route;

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
});

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
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/users/create', [AdminController::class, 'create'])->name('users.create');
        Route::post('/users/store', [AdminController::class, 'store'])->name('users.store');
        Route::resource('products', ProductController::class);
    });
});
