<?php


namespace Modules\Jobs\Repositories;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Modules\Jobs\Entities\Job;

class JobsRepository implements JobsRepositoryInterface
{
    /**
     * @var Job
     */
    private $jobEntity;

    /**
     * @var \Illuminate\Support\MessageBag
     */
    private $errors;

    public function __construct(Job $jobEntity)
    {
        $this->jobEntity = $jobEntity;
    }

    public function listOpenJobs(int $limit = 20)
    {
        return $this->jobEntity->paginate($limit);
    }

    public function createNewJob(array $data): ?Job
    {
        $validator = Validator::make($data, $this->jobEntity->getRules());

        $this->jobEntity->fill($data);

        if ($validator->fails() || !$this->jobEntity->save($data)) {
            $this->errors = $validator->errors();

            return null;
        }

        return $this->jobEntity->fresh();
    }

    public function getErrors(): MessageBag
    {
        return $this->errors;
    }
}
