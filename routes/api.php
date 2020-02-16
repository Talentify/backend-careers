<?php

use App\Http\Controllers\V1\Auth\LoginController;
use App\Http\Controllers\V1\UserController;

/**
 * Guest routes
 */
Route::post('auth/login', [LoginController::class, 'login'])->name('auth.login');

/**
 * Authenticated routes
 */
Route::middleware('auth:api')->group(function () {
    Route::post('auth/logout', [LoginController::class, 'logout'])->name('auth.logout');

    Route::prefix('users')
        ->name('users.')
        ->group(function () {
            Route::get('', [UserController::class, 'index'])
                ->name('index');

            Route::get('count', [UserController::class, 'index'])
                ->name('count');

            Route::post('', [UserController::class, 'store'])
                ->name('store');

            Route::get('{id}', [UserController::class, 'show'])
                ->where('id', '[0-9]+')
                ->name('show');

            Route::patch('{id}', [UserController::class, 'update'])
                ->where('id', '[0-9]+')
                ->name('update');

            Route::delete('{id}', [UserController::class, 'destroy'])
                ->where('id', '[0-9]+')
                ->name('destroy');
        });
});
