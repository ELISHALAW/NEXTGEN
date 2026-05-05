<?php

use App\Http\Controllers\promotionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Adding a name to the route
Route::get('/promotion', [promotionController::class, 'index'])->name('promotion.index');
