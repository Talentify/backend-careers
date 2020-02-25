<?php

/** Public Routes */
Route::group(
    ['prefix' => '', 'namespace' => 'Base', 'as' => 'base.'],
    function () {
        /** Default Home */
        Route::get('/', 'BaseController@index')->name('jobs');

        /** System Unavailable */
        Route::get('unavailable', 'BaseController@unavailable')->name('unavailable');
    }
);

/** Users Routes */
Route::group(
    ['prefix' => 'user', 'namespace' => 'Users', 'as' => 'user.'],
    function () {
        /** Users Register */
        Route::get('register', 'UsersController@create')->name('register');

        /** Validate Login */
        Route::post('register', 'UsersController@store')->name('register.do');
    }
);

/** Login Routes */
Route::group(
    ['prefix' => 'login', 'namespace' => 'Login', 'as' => 'login.'],
    function () {
        /** Validate and Login Form */
        Route::get('/', 'AuthController@showLoginForm')->name('check');

        /** Validate Login */
        Route::post('login', 'AuthController@login')->name('do');

        /** Logout */
        Route::get('logout', 'AuthController@logout')->name('logout');
    }
);

/** Admin Routes */
Route::group(
    ['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'],
    function () {
        /** Protected Routes */
        Route::group(
            ['middleware' => ['auth']],
            function () {
                /** Dashboard Home */
                Route::get('/', 'JobsController@dashboard')->name('dashboard');

                /** Users */
                Route::resource('jobs', 'JobsController');
            }
        );
    }
);
