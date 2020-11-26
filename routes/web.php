<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return "<h1 align='center'>Welcome to Jobs API Version 1.0 written with Lumen</h1><p align='center'><a href='#'><img src='". app('url')->asset('images/image.svg') . "'alt='Logo' width='500' height='500' /></a></p>";
});

$router->post('user', [
    'as' => 'register', 'uses' => 'UserController@store'
]);

$router->post('login', [
    'as' => 'login', 'uses' => 'AuthenticationController@login'
]);

$router->get('job', [
    'as' => 'jobList', 'uses' => 'JobController@show'
]);

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->post('job', [
        'as' => 'jobCreate', 'uses' => 'JobController@store'
    ]);
});
