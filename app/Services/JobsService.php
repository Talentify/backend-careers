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

    /**
     * @param int $id
     * @param array $fields
     * @return Job
     */
    public function update(int $id, array $fields)
    {
        /**
         * @var Job $job
         */
        $job = Job::findOrFail($id);

        $job->title = $fields['title'] ?? $job->title;
        $job->description = $fields['description'] ?? $job->description;
        $job->status = $fields['status'] ?? $job->status;

        if(array_key_exists('salary', $fields)){
            $job->salary = $fields['salary'];
        }

        if(array_key_exists('workplace', $fields)){
            $job->workplace = $fields['workplace'];
        }

        $job->save();

        return $job;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function get(int $id): Job
    {
        return Job::findOrFail($id);
    }

    /**
     * @return mixed
     */
    public function getAll(?array $filters)
    {
       $jobs = Job::orderBy($filters['order'] ?? 'title');

        if (array_key_exists('title', $filters)) {
            $jobs->whereRaw("title like '%{$filters['title']}%'");
        }
        if (array_key_exists('description', $filters)) {
            $jobs->whereRaw("description like '%{$filters['description']}%'");
        }
        if (array_key_exists('street', $filters)) {
            $jobs->whereJsonContains('workplace->street', $filters['street']);
        }
        if (array_key_exists('city', $filters)) {
            $jobs->whereJsonContains('workplace->city', $filters['city']);
        }
        if (array_key_exists('state', $filters)) {
            $jobs->whereJsonContains('workplace->state', $filters['state']);
        }

        return $jobs->paginate(
            $filters['perPage'] ?? 10,
            ['*'],
            'page',
            $filters['page'] ?? 1
        );
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function delete(int $id): void
    {
        /**
         * @var Job $job
         */
        $job = Job::findOrFail($id);
        $job->delete();
    }
}
