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
        $router->get('/{id}', 'JobsController@get');
        $router->get('/', 'JobsController@getAll');

        $router->group(
            ['middleware' => 'auth:admin'],
            function () use ($router) {
                $router->post('/',  'JobsController@create');
                $router->patch('/{id}', 'JobsController@update');
                $router->delete('/{id}', 'JobsController@delete');
            });

        $router->post('/{id}/apply', ['middleware' => 'auth:user','uses' => 'JobsController@apply']);
    }
);

$router->group(
    ['prefix' => 'v1/users'],
    function () use ($router) {
        $router->post('/', 'UsersController@register');

        $router->group(
            ['middleware' => 'auth:user'],
            function () use ($router) {
                $router->get('/login', 'UsersController@login');
                $router->get('/logout', 'UsersController@logout');
                $router->patch('/update', 'UsersController@update');
                $router->get('/', 'UsersController@get');
            });

        $router->group(
            ['middleware' => 'auth:admin'],
            function () use ($router) {
                $router->patch('/{id}/update',  'UsersController@updateById');
                $router->get('/{id}', 'UsersController@getById');
                $router->get('/',  'UsersController@getAll');
                $router->delete('/{id}',  'UsersController@delete');
            });

    }
);

$router->group(
    ['prefix' => 'v1/admins'],
    function () use ($router) {

        $router->group(
            ['middleware' => 'auth:admin'],
            function () use ($router) {
                $router->post('/', 'AdminsController@register');
                $router->get('/login', 'AdminsController@login');
                $router->get('/logout', 'AdminsController@logout');
                $router->patch('/update', 'AdminsController@update');
                $router->get('/', 'AdminsController@get');
                $router->get('/all', 'AdminsController@getAll');
                $router->get('/{id}', 'AdminsController@delete');
            });

    }
);
