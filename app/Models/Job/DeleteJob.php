<?php


namespace App\Models\Job;


class DeleteJob
{
    public static function delete(string $id): void
    {
        $job = GetJob::getJobById($id);
        $job->delete();
    }

}