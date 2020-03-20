<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Vacancy;
use Faker\Generator as Faker;

$factory->define(Vacancy::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'description' => $faker->sentence(),
        'status' => $faker->randomDigit,
        'workplace' => $faker->sentence(),
        'salary' => $faker->randomDigit
    ];
});
