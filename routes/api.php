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

Route::post('/auth', 'LoginController@login');

Route::prefix('jobs')->group(function () {
    Route::get('/status/{status}', 'JobsController@listByStatus');
    Route::get('/{id}', 'JobsController@find');
    Route::get('/', 'JobsController@list');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::prefix('jobs')->group(function () {
        Route::post('/', 'JobsController@create');
        Route::put('/{id}', 'JobsController@update');
        Route::delete('/{id}', 'JobsController@delete');
    });
});