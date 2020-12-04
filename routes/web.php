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

Route::get('/', function () {
    return view('website.home')
        ->with('title', __('Search jobs engine'))
        ->with('route', 'search')
        ->with('page', 0);
});

Route::get('/search/{page?}', function ($page = 0) {
    return view('website.home')
        ->with('title', __('Search jobs engine'))
        ->with('route', 'search')
        ->with('page', $page);
});

Route::get('/login', function () {
    return view('backoffice.login')
        ->with('title', __('Login'));
})->name('login');

Route::get('/logout')
    ->uses('\App\Http\Controllers\LoginController@logout')
    ->middleware('auth');

Route::get('/dashboard/{page?}', function ($page = 0) {
    return view('backoffice.dashboard')
        ->with('title', __('Dashboard'))
        ->with('route', 'dashboard')
        ->with('page', $page);
})
    ->middleware('auth');

Route::get('/jobs/add', function () {
    return view('backoffice.jobs-add')
        ->with('title', __('Add new job'));
})->middleware('auth');

Route::post('/login')
    ->uses('\App\Http\Controllers\LoginController@authenticate')
    ->name('login');

Route::post('/jobs/add')
    ->uses('\App\Http\Controllers\JobsController@store')
    ->name('jobs');
