<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/**
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */

$factory->define(
    App\Models\Job::class,
    function (Faker\Generator $faker) {
        return [
            'title'       => $faker->text,
            'description' => $faker->text,
            'salary'      => $faker->optional()->randomFloat(2),
            'status'      => $faker->randomElement(['enable', 'disable']),
            'workplace'   => $faker->randomElement(
                [
                    null,
                    [
                        'street'  => $faker->streetName,
                        'number'  => $faker->randomNumber(),
                        'city'    => $faker->city,
                        'state'   => $faker->state,
                        'country' => $faker->country
                    ]
                ]
            )
        ];
    }
);
