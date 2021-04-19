<?php

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\JobController;

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

//-----------------------------------PUBLIC-----------------------------
//Recruiter
Route::post('/login', [RecruiterController::class, 'login']);

//Job
Route::get('/jobs', [JobController::class, 'getall']);
Route::get('/openjobs', [JobController::class, 'getopen']);
Route::get('/jobs/{job}', [JobController::class, 'show']);
Route::post('/jobsfilter', [JobController::class, 'filter']);


//-----------------------------------PROTECTED-----------------------------
Route::group(['middleware' => ['auth:sanctum']], function () {
    
    //Recruiter
    Route::post('/register', [RecruiterController::class, 'register']);
    Route::post('/logout', [RecruiterController::class, 'logout']);

    //Company
    Route::get('/companies', [CompanyController::class, 'getall']);
    Route::get('/companies/{company}', [CompanyController::class, 'show']);
    Route::post('/companies', [CompanyController::class, 'store']);

    //Job
    Route::post('/jobs', [JobController::class, 'store']);
    Route::put('/jobs/{job}', [JobController::class, 'update']);
    Route::delete('/jobs/{job}', [JobController::class, 'delete']);
});

