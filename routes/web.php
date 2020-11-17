<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::resource('vacancies', VacancyController::class)->only(['index', 'create', 'store', 'edit', 'update']);
});
