<?php

namespace Database\Factories;

use App\Models\JobVacancies;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobVacanciesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobVacancies::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
//            'id' => 17895,
            'title' => $this->faker->name,
            'description' => 'test',
            'workplace' => $this->faker->address,
            'status' => 'active',
            'salary' => $this->faker->randomFloat(2, 2, 6),
        ];
    }
}
