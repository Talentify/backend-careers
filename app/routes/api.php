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

$router->group(['prefix' => 'auth'], function($router) {
    $router->post('/login', 'AuthController@login');
    $router->post('/refresh', 'AuthController@refresh');
    $router->post('/logout', 'AuthController@logout');
    $router->get('/me', 'AuthController@me');
});

$router->group(['prefix' => 'jobs'], function ($router) {
    $router->get('/', 'JobsController@index');
    $router->post('/', 'JobsController@create');
    $router->put('{jobId}', 'JobsController@update');
    $router->delete('{jobId}', 'JobsController@delete');
});

