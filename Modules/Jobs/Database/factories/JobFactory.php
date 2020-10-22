<?php

namespace Modules\Jobs\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Jobs\Entities\Job;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $allowedStatus = Job::AllOWED_STATUS;

        shuffle($allowedStatus);

        return [
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraphs(10, true),
            'status' => $allowedStatus[0],
            'workplace' => $this->faker->streetAddress,
            'salary' => $this->faker->randomNumber(5)
        ];
    }
}
