<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Vacancy;
use Faker\Generator as Faker;

$factory->define(Vacancy::class, function (Faker $faker) {
    return [
        'title' => $this->faker->name,
        'description' => $this->faker->name,
        'status' => 1,
        'address' => $this->faker->name,
        'salary'=> $this->faker->name,
        'company' => $this->faker->name,
        'recruiter_id' => 1
    ];
});
