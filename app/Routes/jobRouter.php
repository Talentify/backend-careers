<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'jobs', 'namespace' => 'App\Http\Controllers', 'middleware' => 'auth:sanctum'], function ($router) {
    $router->post('/', 'JobController@create');
    $router->put('/{jobId}', 'JobController@update');
});

Route::group(['prefix' => 'jobs', 'namespace' => 'App\Http\Controllers'], function ($router) {
    $router->post('/search', 'JobController@search');
});
