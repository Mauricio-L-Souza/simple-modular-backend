<?php

use Core\Shared\Middleware\CheckBaseApiToken;
use Core\Shared\Middleware\CheckUserAccesses;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::prefix('api')->group(function () {
                Route::middleware(['api', 'auth:sanctum', 'check_user_access'])
                    ->name('customers.')
                    ->group(base_path('core/Customers/routes.php'));

                Route::middleware(['api', 'auth:sanctum', 'check_user_access'])
                    ->name('products.')
                    ->group(base_path('core/Products/routes.php'));

                Route::middleware(['api', 'auth:sanctum', 'check_user_access'])
                    ->name('favorites.')
                    ->group(base_path('core/Favorites/routes.php'));

                Route::middleware(['api', 'check_base_api_token'])
                    ->name('auth.')
                    ->group(base_path('core/Auth/routes.php'));
            });
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'check_base_api_token' => CheckBaseApiToken::class,
            'check_user_access' => CheckUserAccesses::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
