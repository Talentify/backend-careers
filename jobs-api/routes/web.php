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

$router->group(['prefix' => 'api'], function() use ($router) {

    $router->group(['middleware' => ['auth']], function() use ($router) {
        $router->post('jobs/', 'JobsController@store');
        $router->put('jobs/{id}', 'JobsController@update');
        $router->delete('users/{id}', 'UsersController@destroy');
    });

    $router->get('jobs/', 'JobsController@index');
    $router->get('jobs/{id}', 'JobsController@show');
    $router->delete('jobs/{id}', 'JobsController@destroy');
    $router->post('users', 'UsersController@store');
    $router->post('auth/login', 'JWTController@login');
});

