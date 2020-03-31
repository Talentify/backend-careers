<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    protected $faker;

    public function setUp() : void {
        parent::setUp();
        $this->faker = Factory::create();
    }
}
