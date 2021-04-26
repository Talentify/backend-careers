<?php


namespace App\Models\Job;


use App\Models\Company;
use App\Models\Job;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetJob
{
    public static function getJobById(string $id): Job
    {
        try {
            return Job::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public static function getAllOpenJobs()
    {
        try {
            return Job::where('status', Job::JOB_STATUS_OPEN)->get();
        } catch (ModelNotFoundException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public static function getJobBySearch(string $key, string $value)
    {
        try {
            if ($key == 'company') {
                $company = Company::where('name', $value)->firstOrFail();

                $key = 'company_id';
                $value = $company->id;

                $jobs = Job::where($key, $value)
                    ->where('status', Job::JOB_STATUS_OPEN)
                    ->get();

            } else {
                $jobs = Job::where($key, 'LIKE', "%{$value}%")
                    ->where('status', Job::JOB_STATUS_OPEN)
                    ->get();
            }

            if ($jobs->count() == 0) {
                throw new \Exception('No results for this search!', 404);
            }

            return $jobs;
        } catch (ModelNotFoundException $e) {
            throw new \Exception('No results for this search!', 404);
        }
    }

}