<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [ProfilController::class, 'dashboard'])->name('dashboard');
    Route::post('/update-foto', [ProfilController::class, 'updateFoto'])->name('update.foto');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});