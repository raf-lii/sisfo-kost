<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Daftar\AdminDaftarKamarController;
use App\Http\Controllers\Daftar\AdminDaftarPesananController;
use App\Http\Controllers\Daftar\AdminDaftarUserController;
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
    Route::get('/daftar-booking/{id}/bayar',    [DaftarPesananController::class, 'pay'])->name('pembayaran.booking');
});

Route::middleware(['auth', 'check.role'])->group(function(){
    //Daftar Pesanan Controller
    Route::get('/admin/daftar-booking',                         [AdminDaftarPesananController::class, 'create'])->name('admin.daftar.booking');
    Route::get('/admin/daftar-booking/{id}/detail',             [AdminDaftarPesananController::class, 'show'])->name('admin.detail.booking');

    //Daftar User Controller
    Route::get('/admin/daftar-user',                            [AdminDaftarUserController::class, 'create'])->name('admin.daftar.user');
    Route::get('/admin/daftar-user/{id}/hapus',                 [AdminDaftarUserController::class, 'destroy'])->name('admin.hapus.user');

    //Daftar Kamar Controller
    Route::get('/admin/daftar-kamar',                           [AdminDaftarKamarController::class, 'create'])->name('admin.daftar.kamar');
    Route::get('/admin/daftar-kamar/{id}/hapus',                [AdminDaftarKamarController::class, 'destroy'])->name('admin.hapus.kamar');
    Route::post('/admin/daftar-kamar',                          [AdminDaftarKamarController::class, 'store'])->name('admin.tambah.kamar');
    Route::get('/admin/daftar-kamar/{id}/detail',               [AdminDaftarKamarController::class, 'show'])->name('admin.detail.kamar');
    Route::post('/admin/daftar-kamar/update',                   [AdminDaftarKamarController::class, 'patch'])->name('admin.update.kamar');

    //Tipe Pembayaran Controller
    Route::get('/admin/tipe-pembayaran',                        [TipePembayaranController::class, 'create'])->name('admin.tipe-pembayaran');
    Route::get('/admin/tipe-pembayaran/update/{id}/{status}',   [TipePembayaranController::class, 'patch'])->name('admin.update.tipe-pembayaran');
    Route::get('/admin/tipe-pembayaran/{id}/delete',            [TipePembayaranController::class, 'destroy'])->name('admin.hapus.tipe-pembayaran');
    Route::post('/admin/tipe-pembayaran',                       [TipePembayaranController::class, 'store'])->name('admin.tambah.tipe-pembayaran');
});