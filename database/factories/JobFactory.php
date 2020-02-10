<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->word,
        'description' => $faker->unique()->text,
        'status' => $faker->randomElement(['opened' ,'closed']),
        'workplace' => $faker->address,
        'salary' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 99999999),
    ];
});
