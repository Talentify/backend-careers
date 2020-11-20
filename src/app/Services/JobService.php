<?php

namespace App\Services;

use App\Repositories\JobRepository;

class JobService
{

    protected $jobRepository;

    public function __construct(
        JobRepository $jobRepository
    ) {
        $this->jobRepository = $jobRepository;
    }

    /**
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->jobRepository->getAll()->toArray();
    }

    /**
     *
     * @param  type $id
     * @return array
     * @throws \Exception
     */
    public function getByID($id): array
    {
        $result = $this->jobRepository->getByID($id);

        if ($result) {
            return $result->toArray();
        }

        throw new \Exception('Data not found', 404);
    }

    /**
     *
     * @return array
     */
    public function getAllAvailable(): array
    {
        return $this->jobRepository->getAllAvailable()->toArray();
    }

    /**
     *
     * @param  array $data
     * @return type
     */
    public function store(array $data): array
    {
        return $this->jobRepository->create($data)->toArray();
    }

}
