<?php

use App\Http\Controllers\V1\Auth\LoginController;
use App\Http\Controllers\V1\ExampleController;

/**
 * Guest routes
 */
Route::post('auth/login', [LoginController::class, 'login'])->name('auth.login');

/**
 * Authenticated routes
 */
Route::middleware('auth:api')->group(function () {
    Route::post('auth/logout', [LoginController::class, 'logout'])->name('auth.logout');

    Route::prefix('examples')->group(function () {
        Route::get('', [ExampleController::class, 'index'])->middleware('auth:api');
        Route::post('', [ExampleController::class, 'store'])->middleware('auth:api');
        Route::get('{id}', [ExampleController::class, 'show'])->middleware('auth:api');
        Route::patch('{id}', [ExampleController::class, 'update'])->middleware('auth:api');
        Route::delete('{id}', [ExampleController::class, 'destroy'])->middleware('auth:api');
    });
});
