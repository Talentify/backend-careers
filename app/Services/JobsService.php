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
}
