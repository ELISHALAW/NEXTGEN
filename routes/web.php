<?php

use App\Http\Controllers\addToCartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\promotionController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
// Adding a name to the route
Route::get('/shop', [addToCartController::class, 'index'])->name('Shop.index');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/cart/add', [addToCartController::class, 'store'])
    ->middleware('auth')
    ->name('cart.add');
Route::get('/promotion', [promotionController::class, 'index'])->name('promotion.index');
Route::get('/shop', [addToCartController::class, 'index'])->name('Shop.index');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
