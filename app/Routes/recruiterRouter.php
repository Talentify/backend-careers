<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'recruiters', 'namespace' => 'App\Http\Controllers'], function ($router) {
    $router->post('/', 'RecruiterAccessController@register');
    $router->post('/login', 'RecruiterAccessController@login')->name('login');
});
