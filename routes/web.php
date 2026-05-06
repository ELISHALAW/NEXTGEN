<?php

use App\Http\Controllers\addToCartController;
use App\Http\Controllers\promotionController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Adding a name to the route
Route::get('/promotion', [promotionController::class, 'index'])->name('promotion.index');
Route::get('/shop', [addToCartController::class, 'index'])->name('Shop.index');
