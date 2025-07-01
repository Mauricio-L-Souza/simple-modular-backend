<?php

use Illuminate\Support\Facades\Route;
use Core\Favorites\Controllers\FavoriteController;

Route::get('favorites/{favoriteID}', [FavoriteController::class, 'show'])->name('show');
Route::get('favorites/{customerID}/list', [FavoriteController::class, 'index'])->name('index');
Route::post('favorites', [FavoriteController::class, 'store'])->name('store');
Route::delete('favorites/{favoriteID}', [FavoriteController::class, 'destroy'])->name('delete');
