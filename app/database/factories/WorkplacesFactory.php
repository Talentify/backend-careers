<?php

namespace Database\Factories;

use App\Models\Workplaces;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkplacesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Workplaces::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->streetName,
            'address_one' => $this->faker->streetAddress,
            'state' => $this->faker->state,
            'city' => $this->faker->city,
            'postcode' => $this->faker->postcode,
        ];
    }
}
