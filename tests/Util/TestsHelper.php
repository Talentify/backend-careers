<?php


namespace Tests\Util;


use App\Models\Company;
use App\Models\Job;
use App\Models\User;

class TestsHelper
{
    public static function createRecruiterWithFactory()
    {
        $company = Company::factory()->createOne();
        $recruiter = User::factory()->createOne([
            'company_id' => $company->id,
        ]);

        return $recruiter;
    }

    public static function createJobWithFactory($recruiter, $override = [])
    {
        return Job::factory()->createOne(array_merge([
            'company_id' => $recruiter->company_id,
            'recruiter_id' => $recruiter->id,
        ], $override));
    }
}
