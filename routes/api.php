<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/** public routes */

/** auth */
Route::post('auth/login', [\App\Domain\Users\Controllers\AuthController::class, 'login']);

/** users */
Route::post('users', [\App\Domain\Users\Controllers\UserController::class, 'store']);

/** jobs */
Route::get('jobs', [\App\Domain\Jobs\Controllers\JobController::class, 'index']);

/** protected routes */
Route::group(['middleware' => ['auth.jwt']], function () {
    Route::post('jobs',[\App\Domain\Jobs\Controllers\JobController::class, 'store']);
});
