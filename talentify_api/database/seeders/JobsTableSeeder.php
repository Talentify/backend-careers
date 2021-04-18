<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $faker = \Faker\Factory::create();
        
        $jobStatus = ["O", "C"];
        $jobSalary = [7500, 9300, 11000, 5500, 3800, 10800, 8200, 6250];
        $recruitersIds = [1,2,3,4];

        for ($i = 0; $i < 3; $i++) {
            Job::create([
                'id_recruiters_creator' => $recruitersIds[array_rand($recruitersIds)],
                'title' => $faker->jobTitle,
                'description' => $faker->bs,
                'status' => $jobStatus[array_rand($jobStatus)],
                'address' => $faker->address,
                'salary' => $jobSalary[array_rand($jobSalary)],
                'company' => $faker->company,                
            ]);
        }
    }
}
