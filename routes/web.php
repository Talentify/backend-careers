<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicJobsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JobController;

// PUBLIC JOB VIEW
Route::get('/', [PublicJobsController::class, 'index']);

// ADMIN DASHBOARD
Route::prefix('admin')->group(function () {
    Route::post('/auth', [UserController::class, 'signin']);
    Route::get('/login', function () {
        $logged = session('logged');
        if ($logged) {
            header('Location: ../admin');
            die();
        }

        return view('admin.signin');
    });

    Route::get('/logout', function () {
        session()->forget(['logged']);
        session()->flush();
        session()->save();

        header('Location: ../');
        die();
    });

    Route::get('/', function () {
        $logged = session('logged');
        if (!$logged) {
            header('Location: ./login');
            die();
        }

        return view('admin.dashboard');
    });

    Route::get('/jobs', [JobController::class, 'index']);
    Route::post('/jobs', [JobController::class, 'create']);
    Route::get('/jobs/add', [JobController::class, 'show']);
    Route::get('/jobs/{id}', [JobController::class, 'show']);
    Route::put('/jobs/{id}', [JobController::class, 'update']);
    Route::delete('/jobs/{id}', [JobController::class, 'remove']);
});
