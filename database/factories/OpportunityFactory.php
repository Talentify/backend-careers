<?php

namespace Database\Factories;

use App\Models\Opportunity;
use Illuminate\Database\Eloquent\Factories\Factory;

class OpportunityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Opportunity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'       => $this->faker->jobTitle,
            'description' => $this->faker->text,
            'status'      => $this->faker->randomElement(['OPEN', 'CLOSED', 'PAUSED']),
            'workplace'   => $this->faker->address,
            'salary'      => $this->faker->randomFloat(2, 0, 99999),
        ];
    }
}
