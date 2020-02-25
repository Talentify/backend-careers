<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Models\Jobs::class, function (Faker $faker) {
    return [
        'uuid' => Str::uuid()->toString(),
        'company' => $faker->company,
        'title' => $faker->jobTitle,
        'description' => $faker->text(10000),
        'status' => $faker->randomElement(['active','inactive']),
        'workplace' => $faker->streetAddress,
        'salary' => $faker->randomFloat(2,1000,10000),
        'contact' => $faker->email
    ];
});
