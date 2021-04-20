<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $jobStatus = ["O", "C"];
        $jobSalary = [7500, 9300, 11000, 5500, 3800, 10800, 8200, 6250];
        
        return [
            'id_recruiters_creator' => 1,
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->bs,
            'status' => $jobStatus[array_rand($jobStatus)],
            'address' => $this->faker->address,
            'salary' => $jobSalary[array_rand($jobSalary)],
            'company' => $this->faker->company
        ];
    }
}
