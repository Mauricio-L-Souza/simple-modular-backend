<?php

use Illuminate\Support\Facades\Route;
use Core\Auth\Controllers\AuthController;

Route::post('auth/create_user', [AuthController::class, 'createUser'])->name('create_user');
Route::post('auth/authenticate', [AuthController::class, 'generateToken'])->name('authenticate');
