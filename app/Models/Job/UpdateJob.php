<?php


namespace App\Models\Job;


use App\Http\Traits\SetJobStatusTrait;
use App\Models\Job;
use Illuminate\Http\Request;

class UpdateJob
{
    use SetJobStatusTrait;

    public static function update(Request $request, $id): Job
    {
        $job = GetJob::getJobById($id);

        $job->title = $request->title;
        $job->description = $request->description;
        $job->status = self::setJobStatus($request->status);
        $job->address = $request->address;
        $job->salary = $request->salary;
        $job->save();

        return $job;
    }
}