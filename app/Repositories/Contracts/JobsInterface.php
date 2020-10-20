<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface JobsInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param string $status
     * @return Collection
     */
    public function findByStatus(string $status): Collection;

    /**
     * @return Collection
     */
    public function list(): Collection;

    /**
     * @param int $jobId
     * @return mixed
     */
    public function find(int $jobId);

    /**
     * @param array $jobData
     * @return mixed
     */
    public function update(array $jobData);

    /**
     * @param int $jobId
     * @return mixed
     */
    public function delete(int $jobId);
}