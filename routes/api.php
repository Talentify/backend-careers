<?php

use Illuminate\Http\Request;
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

Route::group(['prefix' => 'v1'], function () {
    Route::post('auth/login', 'AuthController@login')->name('login');

    Route::group(['prefix' => 'auth', 'middleware' => 'auth:api'], function () {
        Route::post('logout', 'AuthController@logout')->name('logout');
        Route::post('refresh-token', 'AuthController@refreshToken')->name('refreshToken');
        Route::post('logged-user', 'AuthController@loggedUser')->name('loggedUser');
    });

    Route::middleware('auth:api')->group(function () {
        Route::apiResource('jobs', 'JobController');
    });
});

Route::fallback(function() {
    return response()->json([
        'error' => 'Endpoint ' . url()->current() . ' not found!'
    ], 404);
});

