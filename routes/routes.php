<?php

use Controllers\AuthController;
use Core\Route;

/**
 * Make something great with this app
 * keep simple yahh
 */

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'auth']);

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'submit']);
