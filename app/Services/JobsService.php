<?php

namespace App\Services;

use App\Models\Job;

/**
 * Class JobsService
 * @package App\Services
 */
class JobsService
{
    /**
     * @param array $fields
     * @return Job
     */
    public function create(array $fields): Job
    {
        return Job::create($fields);
    }

    public function update(int $id, array $fields)
    {
        /**
         * @var Job $job
         */
        $job = Job::findOrFail($id);

        $job->title = $fields['title'] ?? $job->title;
        $job->description = $fields['description'] ?? $job->description;
        $job->status = $fields['status'] ?? $job->status;
        $job->salary = $fields['salary'] ?? $job->salary;
        $job->workplace = $fields['workplace'] ?? $job->workplace;

        $job->save();

        return $job;

    }
}
