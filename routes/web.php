<?php

use App\Http\Controllers\Apprenticeship\ApprenticeshipController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Campus\CampusController;
use App\Http\Controllers\CampusDirectory\CampusDirectoryController;
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
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('/career-info', [DashboardController::class, 'careerInfo'])->name('career_info');
    });

    // Campus Directory
    Route::prefix('directory')->name('directory.')->group(function () {
        Route::get('/', [CampusDirectoryController::class, 'index'])->name('index');
        Route::get('/{id}', [CampusDirectoryController::class, 'show'])->name('show');
    });

    // Tracer Study
    Route::prefix('tracer-study')->name('tracer_study.')->group(function () {
        Route::get('/', [TracerStudyController::class, 'index'])->name('index');
        Route::get('/update', [TracerStudyController::class, 'update'])->name('update');
        Route::post('/save-update', [TracerStudyController::class, 'saveUpdate'])->name('save_update');
    });

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/create', [ProfileController::class, 'create'])->name('create');
        Route::post('/', [ProfileController::class, 'store'])->name('store');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::post('/update', [ProfileController::class, 'update'])->name('update');
        Route::get('/career-info', [ProfileController::class, 'careerInfo'])->name('career_info');
    });

    // Campus Info
    Route::prefix('campus')->name('campus.')->group(function () {
        Route::get('/info', [CampusController::class, 'index'])->name('info.index');
        Route::get('/info/{id}', [CampusController::class, 'show'])->name('info.show');
    });

    // Job Vacancy
    Route::prefix('job-vacancy')->name('job_vacancy.')->group(function () {
        // Student & Alumni
        Route::get('/', [JobVacancyController::class, 'index'])->name('index');

        // Alumni only
        Route::middleware('role:alumni')->group(function () {
            Route::get('/my/list', [JobVacancyController::class, 'myJobVacancies'])->name('my');
            Route::get('/create', [JobVacancyController::class, 'create'])->name('create');
            Route::post('/', [JobVacancyController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [JobVacancyController::class, 'edit'])->name('edit');
            Route::put('/{id}', [JobVacancyController::class, 'update'])->name('update');
        });

        // Taruh Paling Bawah
        Route::get('/{id}', [JobVacancyController::class, 'show'])->name('show');
    });
    
    // Apprenticeship
    Route::prefix('apprenticeship')->name('apprenticeship.')->group(function () {
        // Student & Alumni
        Route::get('/', [ApprenticeshipController::class, 'index'])->name('index');

        // Alumni only
        Route::middleware('role:alumni')->group(function () {
            Route::get('/my/list', [ApprenticeshipController::class, 'myApprenticeships'])->name('my');
            Route::get('/create', [ApprenticeshipController::class, 'create'])->name('create');
            Route::post('/', [ApprenticeshipController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ApprenticeshipController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ApprenticeshipController::class, 'update'])->name('update');
        });

        // Taruh Paling Bawah
        Route::get('/{id}', [ApprenticeshipController::class, 'show'])->name('show');
    });
});
