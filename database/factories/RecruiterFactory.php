<?php

use App\Models\Recruiter;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use App\Models\User;

$factory->define(Recruiter::class, function (Faker $faker) {
    return [
        'name' => $faker->userName,
        'birth' => today()->subYears(Arr::random(range(20, 60))),
        'cpf' => $faker->cpf,
        'company' => $faker->company,
        'address' => $faker->address,
        'user_id' => factory(User::class)
    ];
});
