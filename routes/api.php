<?php
use App\Http\Controllers\JobVacanciesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
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

Route::prefix('v1')->group(function () {
    Route::post('login', [SessionController::class, 'login']);
    Route::post('registrations', [UserController::class, 'create']);

    Route::middleware('auth:api')->group(function () {
        Route::post('/create', [JobVacanciesController::class, 'create']);
        Route::get('/index', [JobVacanciesController::class, 'index']);
        Route::put('/update/{id}', [JobVacanciesController::class, 'update']);
        Route::get('/show/{id}', [JobVacanciesController::class, 'show']);
        Route::delete('/delete/{id}', [JobVacanciesController::class, 'destroy']);
    });
});
