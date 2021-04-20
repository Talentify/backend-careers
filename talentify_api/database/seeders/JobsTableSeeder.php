<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Recruiter;
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
        $recruiterIds = $this->get_recruiter_ids();
        
        for ($i = 0; $i < count($jobSalary); $i++) {
            Job::create([
                'id_recruiters_creator' => $recruiterIds[array_rand($recruiterIds)],
                'title' => $faker->jobTitle,
                'description' => $faker->bs,
                'status' => $jobStatus[array_rand($jobStatus)],
                'address' => $faker->address,
                'salary' => $jobSalary[array_rand($jobSalary)],
                'company' => $faker->company,                
            ]);
        }
    }

    public function get_recruiter_ids()
    {   
        $recruiters = Recruiter::select('id')->limit(3)->get();
        $recruiterIds = array();

        foreach ($recruiters as $recruiter) {
            $recruiterIds[] = $recruiter->id;
        }

        return $recruiterIds;
    }
}
