<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RecruiterController;

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

Route::prefix('v1')->group(function ()  {
    Route::post('job', [JobController::class, 'create'])
        ->name('create-job')
        ->middleware(['check.token', 'check.job.body.request']);

    Route::get('job/{id}', [JobController::class, 'read'])
        ->name('get-job')
        ->middleware('check.token');

    Route::put('job/{id}', [JobController::class, 'update'])
        ->name('update-job')
        ->middleware(['check.token', 'check.job.body.request', 'check.recruiter']);

    Route::delete('job/{id}', [JobController::class, 'delete'])
        ->name('delete-job')
        ->middleware('check.token', 'check.recruiter');

    Route::post('recruiter/sign-in', [RecruiterController::class, 'signIn'])
        ->name('sing-in-recruiter')
        ->middleware('check.signin.body.request');

    Route::post('recruiter/sign-up', [RecruiterController::class, 'signUp'])
        ->name('sing-up-recruiter')
        ->middleware('check.signup.body.request');

    Route::get('jobs', [JobController::class, 'getAllOpenJobs'])
        ->name('get-all-open-jobs');

    Route::get('search/jobs', [JobController::class, 'search'])
        ->name('search-jobs');
});


