<?php

use App\Http\Controllers\Apprenticeship\ApprenticeshipController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Campus\CampusController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\JobVacancy\JobVacancyController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\TracerStudy\TracerStudyController;
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

    // Tracer Study
    Route::prefix('tracer-study')->name('tracer_study.')->group(function () {
        Route::get('/', [TracerStudyController::class, 'index'])->name('index');
        Route::get('/update', [TracerStudyController::class, 'update'])->name('update');
        Route::post('/save-update', [TracerStudyController::class, 'saveUpdate'])->name('save_update');
    });

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/update', [ProfileController::class, 'update'])->name('update');
    });

    // Campus Info
    Route::prefix('campus')->name('campus.')->group(function () {
        Route::get('/', [CampusController::class, 'index'])->name('index');
    });

    // Job Vacancy
    Route::prefix('job-vacancy')->name('job_vacancy.')->group(function () {
        Route::get('/', [JobVacancyController::class, 'index'])->name('index');
        Route::get('/create', [JobVacancyController::class, 'create'])->name('create');
        Route::get('/update', [JobVacancyController::class, 'update'])->name('update');
    });
    
    // Apprenticeship
    Route::prefix('apprenticeship')->name('apprenticeship.')->group(function () {
        Route::get('/', [ApprenticeshipController::class, 'index'])->name('index');
        Route::get('/create', [ApprenticeshipController::class, 'create'])->name('create');
        Route::get('/update', [ApprenticeshipController::class, 'update'])->name('update');
    });
});
