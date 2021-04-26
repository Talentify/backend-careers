<?php


namespace App\Models\Job;


use App\Http\Traits\SetJobStatusTrait;
use App\Models\Company\GetCompany;
use App\Models\Recruiter\GetRecruiter;
use App\Models\Job;
use Illuminate\Http\Request;

class CreateJob
{
    use SetJobStatusTrait;

    public static function store(Request $request, string $recruiterId): Job
    {
        $recruiter = GetRecruiter::getRecruiterById($recruiterId);

        $job = Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => self::setJobStatus($request->status),
            'address' => $request->address,
            'salary' => $request->salary,
            'recruiter_id' => $recruiter->id,
            'company_id' => $recruiter->company_id
        ]);

        return  $job;
    }

}