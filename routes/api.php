<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('jobs');
});

Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => "auth."], function () {
    Route::post('/', "AuthController@singin");
    Route::get('/signout', "AuthController@signout");
});

Route::group(['namespace' => 'Jobs','prefix' => 'jobs', 'as' => "job."], function () {
    Route::get('/', "JobController@showAllJobs");
    Route::get('/{id}', "JobController@showOneJob");
});

Route::group(['middleware' => 'auth','prefix' => 'manage', 'as' => "manage."], function () {

    Route::group(['namespace' => 'Jobs','prefix' => 'jobs', 'as' => "job."], function () {
        Route::post('/', "JobController@create");
        Route::put('/{id}', "JobController@update");
        Route::delete('/{id}', "JobController@delete");
    });

});
