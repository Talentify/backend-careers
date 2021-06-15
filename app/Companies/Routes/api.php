<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('companies', 'CompanyController@index')
    ->middleware(['auth:api', 'verified'])
    ->name('companies.index');

Route::post('companies', 'CompanyController@store')
    ->middleware(['auth:api', 'verified'])
    ->name('companies.store');

Route::get('companies/{company}', 'CompanyController@show')
    ->middleware(['auth:api', 'verified'])
    ->name('companies.show');

Route::put('companies/{company}', 'CompanyController@update')
    ->middleware(['auth:api', 'verified'])
    ->name('companies.update');

Route::patch('companies/{company}/disable', 'CompanyController@disable')
    ->middleware(['auth:api', 'verified'])
    ->name('companies.disable');

Route::patch('companies/{company}/enable', 'CompanyController@enable')
    ->middleware(['auth:api', 'verified'])
    ->name('companies.enable');

Route::delete('companies/{company}', 'CompanyController@destroy')
    ->middleware(['auth:api', 'verified'])
    ->name('companies.destroy');
