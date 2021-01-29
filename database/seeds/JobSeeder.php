<?php

use App\Models\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = [
            [
                'title' => 'PHP Senior',
                'description' => 'Remote Fullstack PHP Senior position',
                'status' => 'open',
                'salary' => 10.000,
                'workplace' => 'Remote'
            ]    
        ];

        foreach ($jobs as $job)
        {
            Job::create($job);
        }
    }
}
