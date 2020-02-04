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
        $router->post('/login', 'UsersController@login');
    
        $router->group(
            ['middleware' => 'auth:admin'],
            function () use ($router) {
                $router->delete('/{id}',  'UsersController@delete');
            });
        
        $router->group(
            ['middleware' => 'auth:user'],
            function () use ($router) {
                $router->patch('/', 'UsersController@update');
                $router->get('/', 'UsersController@get');
            });
    
        ;
    }
);

$router->group(
    ['prefix' => 'v1/admins'],
    function () use ($router) {
        $router->post('/login', 'AdminsController@login');
        $router->group(
            ['middleware' => 'auth:admin'],
            function () use ($router) {
                $router->post('/', 'AdminsController@register');
                $router->patch('/', 'AdminsController@update');
                $router->get('/', 'AdminsController@get');
            });

    }
);
