<?php

namespace App\Jobs\Services;

use App\Jobs\Models\Job;

/**
 * Class JobService
 * @package App\Jobs\Services
 */
class JobService
{
    /**
     * @return mixed
     */
    public function findAll()
    {
        return Job::withTrashed()
            ->get();
    }

    /**
     * @param int $id
     * @return Job
     */
    public function findById(int $id)
    {
        return Job::withoutTrashed()
            ->findOrFail($id);
    }

    /**
     * @param array $data
     * @return Job
     */
    public function store(array $data): Job
    {
        $job = new Job;
        $job->company_id = $data['company_id'];
        $job->title = $data['title'];
        $job->description = $data['description'];
        $job->status = $data['status'];
        $job->address = $data['address'];
        $job->salary = $data['salary'];
        $job->save();
        return $job;
    }

    /**
     * @param Job $job
     * @param array $data
     * @return Job
     */
    public function update(Job $job, array $data): Job
    {
        $job->company_id = $data['company_id'];
        $job->title = $data['title'];
        $job->description = $data['description'];
        $job->status = $data['status'];
        $job->address = $data['address'];
        $job->salary = $data['salary'];
        $job->save();
        return $job;
    }

    /**
     * @param Job $job
     * @return Job
     */
    public function enable(Job $job): Job
    {
        $job->restore();
        return $job;
    }

    /**
     * @param Job $job
     * @return Job
     * @throws \Exception
     */
    public function disable(Job $job)
    {
        $job->delete();
        return $job;
    }

    /**
     * @param Job $job
     * @return null
     */
    public function destroy(Job $job)
    {
        $job->forceDelete();
        return null;
    }
}
