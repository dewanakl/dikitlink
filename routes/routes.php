<?php

use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\LandingController;
use App\Controllers\LinkController;
use App\Controllers\ProfileController;
use App\Controllers\StatistikController;
use App\Controllers\UsersController;
use Core\Routing\Route;
use App\Middleware\AdminMiddleware;
use App\Middleware\AuthMiddleware;
use App\Middleware\EmailMiddleware;
use App\Middleware\GuestMiddleware;
use App\Middleware\NoPermissionMiddleware;
use App\Middleware\TemaMiddleware;

/**
 * Make something great with this app
 * keep simple yahh
 */

// Blom login
Route::middleware(GuestMiddleware::class)->group(function () {
    // Landing page
    Route::get('/', LandingController::class)->name('landing');

    Route::controller(AuthController::class)->group(function () {
        // Login
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'auth');

        // Register
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'submit');

        // Forget
        Route::get('/forget', 'forget')->name('forget');
        Route::post('/forget', 'send');
        Route::get('/reset/{id}', 'reset')->name('reset');
    });
});

// Udah login
Route::middleware(AuthMiddleware::class)->group(function () {
    // dashboard
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // list
    Route::get('/list', [DashboardController::class, 'list'])->name('list');

    // CRUD Link API
    Route::prefix('/api/link')->controller(LinkController::class)->group(function () {
        Route::get('/', 'show')->name('show.link');
        Route::post('/', 'create')->name('create.link');

        Route::middleware(NoPermissionMiddleware::class)->group(function () {
            Route::get('/detail', 'detail')->name('detail.link');
            Route::put('/', 'update')->name('update.link');
            Route::delete('/', 'delete')->name('delete.link');
        });
    });

    // statistik
    Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik');
    Route::get('/statistik/download', [StatistikController::class, 'download'])->name('statistik.download');

    // profile
    Route::controller(ProfileController::class)->prefix('/profile')->group(function () {
        Route::middleware(TemaMiddleware::class)->group(function () {
            Route::get('/', 'index')->name('profile');
            Route::put('/', 'update');
        });
        Route::get('/avatar', 'avatar')->name('avatar');
        Route::get('/log', 'log')->name('log');
        Route::put('/statistik', 'statistik')->name('statistik.profile');
        Route::post('/delete', 'delete')->name('hapus.profile');

        Route::middleware(EmailMiddleware::class)->group(function () {
            Route::post('/email', 'email')->name('email');
            Route::get('/email/{id}', 'verify')->name('verify');
        });
    });

    // logout
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin only
    Route::prefix('/admin')->middleware(AdminMiddleware::class)->group(function () {
        Route::prefix('/users')->controller(UsersController::class)->group(function () {
            Route::get('/', 'index')->name('users');
            Route::get('/{id}/detail', 'detail');
            Route::delete('/{id}/delete', 'delete')->name('delete.users');
        });

        Route::get('/stats', [AdminController::class, 'index'])->name('stats');
    });
});

// Redirect it
Route::get('/{id}', [StatistikController::class, 'click'])->name('click');
Route::post('/{id}', [StatistikController::class, 'click']);
