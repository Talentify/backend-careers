<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Position;
use App\Models\Recruiter;
use App\Models\Company;

$factory->define(Position::class, function (Faker $faker) {
    $company = Company::create([
        'name' => 'Foo Company'
    ]);

    $company2 = Company::create([
        'name' => 'Foo Company 2'
    ]);

    $recruiter = Recruiter::create([
        "name" => "Recruiter Test",
        "email" => "foo@email.com",
        "password" => "secret",
        "company_id" => $company->id
    ]);

    $recruiter2 = Recruiter::create([
        "name" => "Recruiter 2 Test",
        "email" => "fo2o@email.com",
        "password" => "secret",
        "company_id" => $company2->id
    ]);

    return [
        "title" => "Dev Laravel",
        "description" => "Desc Laravel",
        "address" => "Address Laravel",
        "salary" => "17000",
        "status" => 1,
        "company_id" => $company->id,
        "recruiter_id" => $recruiter->id
    ];
});
