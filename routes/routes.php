<?php

use Controllers\AuthController;
use Controllers\DashboardController;
use Controllers\LandingController;
use Controllers\LinkController;
use Controllers\ProfileController;
use Controllers\StatistikController;
use Core\Route;
use Middleware\AuthMiddleware;
use Middleware\GuestMiddleware;

/**
 * Make something great with this app
 * keep simple yahh
 */

// Landing page
Route::get('/', LandingController::class)->name('landing');

// Blom login
Route::middleware(GuestMiddleware::class)->group(function () {
    Route::controller(AuthController::class)->group(function () {
        // Login
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'auth');

        // Register
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'submit');
    });
});

// Udah login
Route::middleware(AuthMiddleware::class)->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/statistik', StatistikController::class)->name('statistik');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update']);

    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

    // CRUD Link
    Route::controller(LinkController::class)->prefix('/link')->group(function () {
        Route::post('/show', 'show')->name('show.link');
        Route::post('/{id}/detail', 'detail')->name('detail.link');
        Route::post('/create', 'create')->name('create.link');
        Route::put('/{id}/update', 'update')->name('update.link');
        Route::delete('/{id}/delete', 'delete')->name('delete.link');
    });
});

// Redirect it
Route::get('/{id}', [LinkController::class, 'click'])->name('click');
