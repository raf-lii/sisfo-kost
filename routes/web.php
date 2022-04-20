<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Daftar\DaftarPesananController;
use App\Http\Controllers\Dashboard\BookingController;
use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Pembayaran\KategoriPembayaranController;
use App\Http\Controllers\Pembayaran\TipePembayaranController;
use App\Http\Controllers\Pembayaran\iPaymuController;

Route::post('/callback',                        [iPaymuController::class, 'handle'])->name('callback');

Route::middleware(['guest'])->group(function(){
    //Masuk route
    Route::get('/masuk',                        [AuthenticateController::class, 'create'])->name("login");
    Route::post('/masuk',                       [AuthenticateController::class, 'store'])->name("login.post");
    
    //Daftar route
    Route::get('/daftar',                       [RegisterController::class, 'create'])->name("register");
    Route::post('/daftar',                      [RegisterController::class, 'store'])->name("register.post");
});

Route::middleware(['auth'])->group(function() {
    //Dashboard route
    Route::get('/',                             [IndexController::class, 'create'])->name('dashboard');
    Route::post('/',                            [IndexController::class, 'show'])->name("dashboard.post");

    //Booking route
    Route::get('/booking',                      [BookingController::class, 'create'])->name("booking");
    Route::post('/bookings',                    [BookingController::class, 'store'])->name('booking.post');
    
    //Ajax tipe pembayaran route
    Route::post('/tipe-pembayaran',             [TipePembayaranController::class, 'show'])->name('ajax.tipePembayaran');

    //Daftar booking user route
    Route::get('/daftar-booking',               [DaftarPesananController::class, 'create'])->name('daftar.booking');    
    Route::get('/daftar-booking/{id}/detail',   [DaftarPesananController::class, 'show'])->name('detail.booking');
});