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

Route::get('/', 'WelcomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('dashboard');

Route::post('/search', 'WelcomeController@search')->name('search');

Route::get('/opportunities/{opportunityId}', 'OpportunitiesController@show')->name('opportunities.show');

Route::get('/apply/{opportunityId}', 'HomeController@apply')->name('apply');

Route::group(['namespace' => 'Admin', 'as' => 'admin.', 'prefix' => 'admin'], function() {

    Route::group(['middleware' => 'role'], function() {
        Route::get('/', 'AdminController@index')->name('home');
        Route::get('/home', 'AdminController@index')->name('dashboard');
        Route::get('/logout', 'AdminController@logOut')->name('logout');

        Route::group(['as' => 'opportunity.', 'prefix' => 'opportunity'], function() {
            Route::get('/search', 'AdminController@search')->name('search');
            Route::get('/new', 'AdminController@create')->name('create');
            Route::post('/new', 'AdminController@store')->name('store');
            Route::get('/{opportunityId}/edit', 'AdminController@getEdit')->name('getEdit');
            Route::post('/{opportunityId}/edit', 'AdminController@postEdit')->name('postEdit');
            Route::delete('/{opportunityId}/delete', 'AdminController@postDelete')->name('postDelete');
        });
    });

    Route::get('login', 'LoginController@showLogin')->name('showLogin');
    Route::post('login', 'LoginController@login')->name('login');
});
