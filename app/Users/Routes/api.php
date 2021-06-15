<?php



Route::put('/users/{user}/enable', 'UserController@enable')
    ->middleware(['auth:api', 'verified'])
    ->name('users.enable');

Route::put('/users/{user}/disable', 'UserController@disable')
    ->middleware(['auth:api', 'verified'])
    ->name('users.disable');

Route::apiResource('users', 'UserController')
    ->middleware(['auth:api', 'verified'])
    ->only(['index', 'store', 'update', 'destroy']);
