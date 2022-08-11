<?php

use Controllers\AuthController;
use Controllers\DashboardController;
use Controllers\LandingController;
use Controllers\LinkController;
use Controllers\ProfileController;
use Controllers\StatistikController;
use Controllers\UsersController;
use Core\Routing\Route;
use Middleware\AdminMiddleware;
use Middleware\AuthMiddleware;
use Middleware\GuestMiddleware;

/**
 * Make something great with this app
 * keep simple yahh
 */

// Landing page
Route::get('/', LandingController::class)->name('landing');

// Blom login
Route::middleware(GuestMiddleware::class)->controller(AuthController::class)->group(function () {
    // Login
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'auth');

    // Register
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'submit');
});

// Udah login
Route::middleware(AuthMiddleware::class)->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update']);

    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

    // CRUD Link API
    Route::controller(LinkController::class)->prefix('/api/link')->group(function () {
        Route::get('/show', 'show')->name('show.link');
        Route::get('/detail', 'detail')->name('detail.link');
        Route::post('/create', 'create')->name('create.link');
        Route::put('/update', 'update')->name('update.link');
        Route::delete('/delete', 'delete')->name('delete.link');
    });

    // Admin only
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::controller(UsersController::class)->prefix('/users')->group(function () {
            Route::get('/', 'index')->name('users');
            Route::get('/{id}/detail', 'detail');
            Route::put('/{id}/update', 'update')->name('update.users');
            Route::delete('/{id}/delete', 'delete')->name('delete.users');
        });
    });
});

// Redirect it
Route::get('/{id}', [StatistikController::class, 'click'])->name('click');
