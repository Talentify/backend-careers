<?php

namespace App\Providers;

use App\Repositories\AnswerPdoRepository;
use App\Repositories\Contracts\AnswerRepositoryInterface;
use App\Repositories\Contracts\JobsInterface;
use App\Repositories\contracts\VisitRepositoryInterface;
use App\Repositories\JobsEloquentRepository;
use App\Repositories\VisitEloquentRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(JobsInterface::class, JobsEloquentRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
