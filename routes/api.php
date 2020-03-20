<?php

use App\Http\Controllers\V1\Auth\LoginController;
use App\Http\Controllers\V1\PositionController;

/**
 * Guest routes
 */
Route::post('auth/login', [LoginController::class, 'login'])->name('auth.login');

/**
 * Authenticated routes
 */
Route::middleware('auth:api')->group(function () {
    Route::post('auth/logout', [LoginController::class, 'logout'])->name('auth.logout');

    /**
     * Positions
     */
    Route::prefix('positions')
        ->name('positions.')
        ->group(function () {
            Route::post('', [PositionController::class, 'store'])
                ->name('store');
        });
});

/**
 * Public Positions
 */
Route::prefix('positions')
    ->name('positions.')
    ->group(function () {
        Route::get('', [PositionController::class, 'index'])
            ->name('index');
    });
