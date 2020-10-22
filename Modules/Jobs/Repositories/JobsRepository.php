<?php


namespace Modules\Jobs\Repositories;


use Modules\Jobs\Entities\Job;

class JobsRepository implements JobsRepositoryInterface
{
    /**
     * @var Job
     */
    private $jobEntity;

    public function __construct(Job $jobEntity)
    {
        $this->jobEntity = $jobEntity;
    }

    public function listOpenJobs(int $limit = 20)
    {
        return $this->jobEntity->paginate($limit);
    }
}
