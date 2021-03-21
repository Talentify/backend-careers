<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'web\VacancyController@welcome')->name('vacancies.welcome');
Route::post('/', 'web\VacancyController@seeVacancies')->name('vacancies.seeVacancies');

Auth::routes(['register' => false]);

Route::get('/home', 'web\VacancyController@seeVacancies')->name('home');
Route::resource("companies", "web\CompanyController", ['except' => []]);
Route::resource("recruiters", "web\RecruiterController", ['except' => []]);

Route::resource("vacancies", "web\VacancyController", ['except' => []]);
Route::get('myvacancies', "web\VacancyController@myVacancies")->name('vacancies.myvacancies');
