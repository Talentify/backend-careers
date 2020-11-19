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

Route::prefix('v1')->namespace('Api')->group(function () {

    Route::post('login', 'SessionController@login');
    Route::post('registrations', 'UserController@create');
    Route::post('registrations', 'UserController@create');

    Route::middleware('auth:api')->group(function () {

        Route::post('create', 'ProductController@list');
        Route::put('update/{id}', 'ProductController@show');
        Route::delete('delete/favorite', 'ProductController@favorite');

    });
});
