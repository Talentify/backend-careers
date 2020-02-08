<?php

/** @var Factory $factory */

use App\Models\V1\Example;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Example::class, fn(Faker $faker) => [
    'name' => $faker->name,
    'email' => $faker->unique()->safeEmail,
]);
