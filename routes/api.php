<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware'=>'auth:api'], function(){
//Rotas das vagas
Route::post('vacancy-create', 'VacancyController@store');
Route::put('vacancy-update/{id}', 'VacancyController@update');
});

//Rotdas Buscar Vagas
Route::get('vacancy-all', 'VacancyController@index');
Route::get('vacancy-show', 'VacancyController@show');

//Rotas de autenticação/login
Route::post('login', 'Auth\AuthenticateController@authenticate');
Route::post('login-refresh', 'Auth\AuthenticateController@refreshToken');
Route::get('search-login', 'Auth\AuthenticateController@getAuthenticatedUser');

//Rota para cadastro de recrutador
Route::post('store-recruiter', 'UserController@store');