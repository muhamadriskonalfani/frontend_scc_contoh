<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('index');

Route::prefix('auth')->name('auth.')->group(function () {
    // Guest only (belum login)
    Route::middleware('guest')->group(function () {
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        
        Route::get('/register-meta', [AuthController::class, 'registerMeta'])->name('register_meta');
        Route::post('/register', [AuthController::class, 'register'])->name('register');
    });

    // Authenticated users only
    Route::middleware('frontend.auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});

Route::middleware('frontend.auth')->group(function () {
    // Home / Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});
