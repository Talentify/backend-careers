<?php

namespace Tests;

use App\Models\UsuarioSistema;
use App\Services\Login\LoginService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;


abstract class DatabaseTestCase extends TestCase
{
    public function setUp():void
    {
        parent::setUp();

        $this->artisan('test',['--env' => 'testing']);

        $this->artisan('migrate');
        $this->artisan('db:seed');

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback');
        });

    }

    public function signIn()
    {
        $user = $this->json('POST', route('api.login'),[
            'username' => 'jsilveira',
            'password' => '123456'
        ]);

        // session()->put('user', $user);
        auth()->user();

        return $user;

    }
}
