<?php

namespace App\Http\Traits;



use App\Models\Job;

trait SetJobStatusTrait
{
    public static function setJobStatus(string $status): string
    {
        if ($status == Job::JOB_STATUS_CLOSE) {
            return Job::JOB_STATUS_CLOSE;
        }

        return Job::JOB_STATUS_OPEN;
    }
}