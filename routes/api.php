<?php

use Illuminate\Http\Request;

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

Route::get('/', 'Controller@root');

Route::fallback('Controller@fallback');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('jobs.')->prefix('jobs')->get('/', 'JobController@index')->name('list');

Route::name('job.')->prefix('job')->group(function () {
    Route::get('/{jobId}', 'JobController@show')->name('view');
    Route::post('/', 'JobController@store')->name('insert');
    Route::put('/{jobId}', 'JobController@update')->name('update');
    Route::delete('/{jobId}', 'JobController@destroy')->name('delete');
});
