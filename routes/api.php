<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('auth', 'Auth\AuthApiController@authenticate')->name('api.login');
Route::post('auth-refresh', 'Auth\AuthApiController@refreshToken');
Route::post('register', 'Api\Register\RegisterRecruiterController@register')->name('api.register');
Route::get('me', 'Auth\AuthApiController@getAuthenticatedUser');

Route::get('list-vacancies', 'Api\v1\VacancyController@list')->name('listVacancies');


Route::middleware('auth:api')->name('v1.')->prefix('v1')->namespace('Api\v1')->group(function(){


    Route::name('vacancies.')->prefix('vacancies')->group(function(){

        Route::get('list-vacancies-by-user', 'VacancyController@listVacanciesByUser')->name('listVacanciesByUser');
        Route::post('create', 'VacancyController@store')->name('create');
        Route::put('create/{id}', 'VacancyController@update')->name('update');
        Route::delete('destroy/{id}', 'VacancyController@destroy')->name('destroy');
    });


});
