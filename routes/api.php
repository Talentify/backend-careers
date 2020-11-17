<?php

use App\Infrastructure\Auth\AuthController;
use Domain\Jobs\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use Infrastructure\Http\Controllers\HomeController;

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
/**
 * public routes
 */
Route::get('/jobs', [JobController::class, 'getAll'])->middleware('cacheResponse:jobs');
Route::get('/jobs/search/', [JobController::class, 'search'])->middleware('cacheResponse:jobs');
Route::get('/jobs/{id}', [JobController::class, 'getOne'])->middleware('cacheResponse:jobs');


/**
 * public auth routes
 */
Route::prefix('auth')->group(
    function () {
        Route::post('/signup', [AuthController::class, 'signup']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
    }
);
/**
 * private routes
 */
Route::middleware(['auth:api'])->group(
    function () {
        Route::prefix('admin')->group(
            function () {
                Route::get('/jobs', [JobController::class, 'getAll'])->middleware('cacheResponse:jobs');
                Route::get('/jobs/search/', [JobController::class, 'search'])->middleware('cacheResponse:jobs');
                Route::get('/jobs/{id}', [JobController::class, 'getOne'])->middleware('cacheResponse:jobs');
                Route::post('/jobs', [JobController::class, 'saveOne']);
                Route::put('/jobs/{id}', [JobController::class, 'updateOne']);
                Route::delete('/jobs/{id}', [JobController::class, 'deleteOne']);
            }
        );
        Route::prefix('auth')->group(
            function () {
                Route::get('user', [AuthController::class, 'me']);
                Route::get('logout', [AuthController::class, 'logout']);
            }
        );
    }
);
