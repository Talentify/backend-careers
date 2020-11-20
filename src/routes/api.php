<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
    'namespace' => 'App\Http\Controllers'
        ],
        function() {
    Route::post('login', 'UserController@login')->name('login');
});

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    Route::get('jobs/available', 'JobController@available');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('auth/logout', 'UserController@logout');
        Route::resource('jobs', 'JobController');
    }
    );
});

