<?php

namespace Test;

use Laravel\Lumen\Testing\DatabaseTransactions;
use Laravel\Lumen\Testing\TestCase as LaravelTestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;

abstract class TestCase extends LaravelTestCase
{
    use DatabaseTransactions, DatabaseMigrations;

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__ . '/../bootstrap/app.php';
    }
}
