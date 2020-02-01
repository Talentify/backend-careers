<?php

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

/**
 * @var \Laravel\Lumen\Routing\Router $router
 */
$router->get(
    '/',
    function () use ($router) {
        return $router->app->version();
    }
);

$router->group(
    ['prefix' => 'v1/jobs'],
    function () use ($router) {
        $router->post('/', 'JobsController@create');
        $router->get('/', 'JobsController@getAll');
        $router->patch('/{id}', 'JobsController@update');
        $router->get('/{id}', 'JobsController@get');
        $router->delete('/{id}', 'JobsController@delete');
    }
);
