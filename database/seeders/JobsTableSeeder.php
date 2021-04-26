<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Job;
use App\Models\Recruiter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createOpenJobs();
        $this->createCloseJobs();
    }

    private function createOpenJobs()
    {
        $recruiterA = Recruiter::where('name', 'Recruiter One')->firstOr();
        $companyA = Company::where('name', 'Company A')->firstOr();

        DB::table('jobs')->insert([
            'id' => Str::uuid(),
            'title' => 'Job company A',
            'description' => 'Example of job for company A Open',
            'status' => Job::JOB_STATUS_OPEN,
            'address' => 'Street A number One',
            'salary' => 5000,
            'company_id' => $companyA->id,
            'recruiter_id' => $recruiterA->id
        ]);

        $recruiterB = Recruiter::where('name', 'Recruiter Two')->firstOr();
        $companyB = Company::where('name', 'Company B')->firstOr();

        DB::table('jobs')->insert([
            'id' => Str::uuid(),
            'title' => 'Job company B',
            'description' => 'Example of job for company B Open',
            'status' => Job::JOB_STATUS_OPEN,
            'address' => 'Street B number Two',
            'salary' => 6350.98,
            'company_id' => $companyB->id,
            'recruiter_id' => $recruiterB->id
        ]);

        $recruiterC = Recruiter::where('name', 'Recruiter Three')->firstOr();
        $companyC = Company::where('name', 'Company C')->firstOr();

        DB::table('jobs')->insert([
            'id' => Str::uuid(),
            'title' => 'Job company C',
            'description' => 'Example of job for company C Open',
            'status' => Job::JOB_STATUS_OPEN,
            'address' => 'Street C number Three',
            'salary' => 1050.50,
            'company_id' => $companyC->id,
            'recruiter_id' => $recruiterC->id
        ]);
    }

    private function createCloseJobs()
    {
        $recruiterA = Recruiter::where('name', 'Recruiter One')->firstOr();
        $companyA = Company::where('name', 'Company A')->firstOr();

        DB::table('jobs')->insert([
            'id' => Str::uuid(),
            'title' => 'Job company A',
            'description' => 'Example of job for company A Close',
            'status' => Job::JOB_STATUS_CLOSE,
            'address' => 'Street A number One',
            'salary' => 3000,
            'company_id' => $companyA->id,
            'recruiter_id' => $recruiterA->id
        ]);

        $recruiterB = Recruiter::where('name', 'Recruiter Two')->firstOr();
        $companyB = Company::where('name', 'Company B')->firstOr();

        DB::table('jobs')->insert([
            'id' => Str::uuid(),
            'title' => 'Job company B',
            'description' => 'Example of job for company B Close',
            'status' => Job::JOB_STATUS_CLOSE,
            'address' => 'Street B number Two',
            'salary' => 2000,
            'company_id' => $companyB->id,
            'recruiter_id' => $recruiterB->id
        ]);

        $recruiterC = Recruiter::where('name', 'Recruiter Three')->firstOr();
        $companyC = Company::where('name', 'Company C')->firstOr();

        DB::table('jobs')->insert([
            'id' => Str::uuid(),
            'title' => 'Job company C',
            'description' => 'Example of job for company C Close',
            'status' => Job::JOB_STATUS_CLOSE,
            'address' => 'Street C number Three',
            'salary' => 900,
            'company_id' => $companyC->id,
            'recruiter_id' => $recruiterC->id
        ]);
    }

}
