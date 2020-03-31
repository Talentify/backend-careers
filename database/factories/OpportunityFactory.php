<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Opportunities;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Opportunities::class, function (Faker $faker) {
    return [
        'id' => 1,
        'title' => $faker->jobTitle,
        'description' => $faker->text,
        'status' => 'active'
    ];
});

$factory->state(App\Opportunities::class, 'active-status', [
    'status' => 'active'
]);

$factory->state(App\Opportunities::class, 'paused-status', [
    'status' => 'paused'
]);

$factory->state(App\Opportunities::class, 'inactive-status', [
    'status' => 'inactive'
]);

$factory->state(App\Opportunities::class, 'with-workplace', [
    'workplace' => 'Test workplace'
]);

$factory->state(App\Opportunities::class, 'with-salary', [
    'salary' => 1000.000
]);
