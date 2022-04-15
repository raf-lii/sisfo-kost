<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\BookingController;
use App\Http\Controllers\Dashboard\IndexController;

Route::middleware(['guest'])->group(function(){
    Route::get('/masuk',        [AuthenticateController::class, 'create'])->name("login");
    Route::post('/masuk',       [AuthenticateController::class, 'store'])->name("login.post");
    Route::get('/daftar',       [RegisterController::class, 'create'])->name("register");
    Route::post('/daftar',      [RegisterController::class, 'store'])->name("register.post");
});

Route::middleware(['auth'])->group(function() {
    Route::get('/',             [IndexController::class, 'create'])->name('dashboard');
    Route::post('/',            [IndexController::class, 'show'])->name("dashboard.post");
    Route::get('/booking',      [BookingController::class, 'create'])->name("booking");
    Route::post('/booking',     [BookingController::class, 'store'])->name('booking.post');
});
