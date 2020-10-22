<?php

namespace App\Job\Domain\Repository;

use App\Job\Domain\Entity\Job;

/**
 * Interface JobRepository
 * @package App\Job\Domain\Repository
 */
interface JobRepository
{
    /**
     * @param Job $job
     * @return Job
     */
    public function save(Job $job): Job;

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * @param Job $job
     */
    public function delete(Job $job): void;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param array $filters
     * @return array
     */
    public function findBy(array $filters = []): array;

    /**
     * @param Job $job
     * @return Job
     */
    public function update(Job $job): Job;
}
