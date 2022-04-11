<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\Auth\RegisterController;

Route::middleware(['guest'])->group(function(){
    Route::get('/masuk',        [AuthenticateController::class, 'create'])->name("login");
    Route::post('/masuk',       [AuthenticateController::class, 'store'])->name("login.post");
    Route::get('/daftar',       [RegisterController::class, 'create'])->name("register");
    Route::post('/daftar',      [RegisterController::class, 'store'])->name("register.post");
});

Route::get('/', function () {
    return view('main');
})->middleware(['auth']);
