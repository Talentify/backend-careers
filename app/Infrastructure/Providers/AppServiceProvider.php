<?php

namespace Infrastructure\Providers;

use App\Core\Requests\AbstractRequestInterface;
use Core\Requests\AbstractCrudRequestInterface;
use Core\Requests\AbstractRequest;
use Domain\Jobs\Controllers\JobController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(AbstractRequestInterface::class, AbstractRequest::class);
    }
}
