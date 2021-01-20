<?php

namespace Database\Factories;

use App\Models\JobOpportunity;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobOpportunityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobOpportunity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'workplace'     =>  $this->faker->address,
            'title'         =>  $this->faker->title,
            'description'   =>  $this->faker->text(1000),
            'salary'        =>  $this->faker->numberBetween(1200, 30000),
            'status'        =>  'active'
        ];
    }
}
