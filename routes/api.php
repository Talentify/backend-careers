<?php

Route::prefix('v1')->group(function () {

    Route::post('auth/login', 'Api\\AuthController@login');

    //Positions
    Route::get('positions-open', 'Api\\PositionController@listOpenPositions');
    Route::post('positions-open-search', 'Api\\PositionController@searchOpenPositions');

    Route::group(['middleware' => ['apiJwt']], function () {
        Route::post('logout', 'Api\\AuthController@logout');

        //Company
        Route::resource('companies', 'Api\\CompanyController', ['except' => ['create', 'edit', 'update', 'destroy']]);

        //Recruiter
        Route::resource('recruiters', 'Api\\RecruiterController', ['except' => ['create', 'edit', 'update', 'destroy']]);

        //Positions
        Route::resource('positions', 'Api\\PositionController', ['except' => ['create', 'edit']]);

        Route::post('auth/logout', 'Api\\AuthController@logout');

    });
});

