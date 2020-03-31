<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$j702KbD5lVHNOmxsEflohej9j8VsHCW01g53BRYKycsGrkgz0xknO',
    ];
});

$factory->state(App\User::class, 'admin', [
    'name' => 'Admin user',
    'email' => 'admin-test@talentify.com',
    'type' => 'admin'
]);

$factory->state(App\User::class, 'client', [
    'name' => 'Client user',
    'email' => 'client-test@talentify.com',
    'type' => 'client'
]);
