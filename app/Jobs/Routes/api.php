<?php

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

Route::get('jobs-public', 'JobController@index')
    ->name('jobs.index');

Route::get('jobs', 'JobController@index')
    ->middleware(['auth:api', 'verified'])
    ->name('jobs.index');

Route::post('jobs', 'JobController@store')
    ->middleware(['auth:api', 'verified'])
    ->name('jobs.store');

Route::get('jobs/{job}', 'JobController@show')
    ->middleware(['auth:api', 'verified'])
    ->name('jobs.show');

Route::put('jobs/{job}', 'JobController@update')
    ->middleware(['auth:api', 'verified'])
    ->name('jobs.update');

Route::patch('jobs/{job}/disable', 'JobController@disable')
    ->middleware(['auth:api', 'verified'])
    ->name('jobs.disable');

Route::patch('jobs/{job}/enable', 'JobController@enable')
    ->middleware(['auth:api', 'verified'])
    ->name('jobs.enable');

Route::delete('jobs/{job}', 'JobController@destroy')
    ->middleware(['auth:api', 'verified'])
    ->name('jobs.destroy');
