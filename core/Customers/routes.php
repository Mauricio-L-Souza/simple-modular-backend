<?php

use Illuminate\Support\Facades\Route;
use Core\Customers\Controllers\CustomerController;

Route::get('customers/{customerID}', [CustomerController::class, 'show'])->name('show');
Route::post('customers', [CustomerController::class, 'store'])->name('store');
Route::put('customers/{customerID}', [CustomerController::class, 'update'])->name('update');
Route::delete('customers/{customerID}', [CustomerController::class, 'delete'])->name('delete');
