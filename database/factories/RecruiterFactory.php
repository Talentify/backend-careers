<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Recruiter;
use App\Models\Company;

$factory->define(Recruiter::class, function (Faker $faker) {

    $company = Company::create([
        'name' => 'Foo Company'
    ]);

    $company2 = Company::create([
        'name' => 'Foo Company 2'
    ]);

    return [
        'name' => 'User Teste',
        'email' => $faker->email,
        'password' => 'secret',
        'company_id' => $company->id
    ];
});
