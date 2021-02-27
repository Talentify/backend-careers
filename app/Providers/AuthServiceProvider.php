<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        try {
            //sets permissions dynamically
            $permissions = Permission::with('roles')->get();

            foreach ($permissions as $p) {
                Gate::define($p->name, function (User $user) use ($p) {
                    return $user->hasRole($p->roles);
                });
            }
        } catch (QueryException $e) {
            Log::error("First execution of the migration accuses error of lack of table.");
        }
    }
}
