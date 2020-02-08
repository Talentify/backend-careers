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
});
