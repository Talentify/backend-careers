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

Route::post('recruiters/create','RecruiterController@store');

Route::post('jobs/create','JobController@store')->middleware('auth');
Route::put('jobs/{id}','JobController@update')->middleware('auth');
Route::delete('jobs/{id}','JobController@destroy')->middleware('auth');

Route::get('jobs/{id}','JobController@show');
Route::get('jobs','JobController@index');
Route::get('jobs-search/','JobController@search');

Route::post('recruiters/login','RecruiterController@login');
