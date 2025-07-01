<?php

use Illuminate\Support\Facades\Route;
use Core\Products\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index'])->name('index');
Route::get('/products/{productID}', [ProductController::class, 'show'])->name('show');
