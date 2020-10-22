<?php

namespace App\Job\Service;

use App\Job\Domain\Entity\Job;
use App\Job\Domain\Exceptions\RecordNotFoundException;
use App\Job\Domain\Repository\JobRepository;
use Webmozart\Assert\Assert;

/**
 * Class JobService
 * @package App\Job\Infrastructure\Service
 */
class JobService
{
    /**
     * @var JobRepository
     */
    private $jobRepository;

    /**
     * JobService constructor.
     * @param JobRepository $jobRepository
     */
    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    /**
     * @return \App\Job\Domain\Entity\Job[]|array
     */
    public function findAll()
    {
        return $this->jobRepository->findAll();
    }

    /**
     * @param array $data
     * @return Job
     */
    public function create(array $data)
    {
        $this->validateData($data);
        $entity = new Job();
        $entity->setTitle($data['title'])
            ->setDescription($data['description'])
            ->setWorkplace($data['workplace'] ?? null)
            ->setSalary($data['salary'] ?? null)
            ->setStatus($data['status'] ?? $entity->getStatus());

        return $this->jobRepository->save($entity);
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function update(int $id, array $data)
    {
        $this->validateData($data, false);
        $job = $this->jobRepository->find($id);

        if (is_null($job)) {
            throw new RecordNotFoundException();
        }

        $job->setTitle($data['title'] ?? $job->getTitle())
            ->setDescription($data['description'] ?? $job->getDescription())
            ->setWorkplace($data['workplace'] ?? $job->getWorkplace())
            ->setSalary($data['salary'] ?? $job->getSalary())
            ->setStatus($data['status'] ?? $job->getStatus());

        return $this->jobRepository->update($job);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws RecordNotFoundException
     */
    public function find(int $id)
    {
        $job = $this->jobRepository->find($id);

        if (is_null($job)) {
            throw new RecordNotFoundException;
        }

        return [
            'id'          => $job->getId(),
            'title'       => $job->getTitle(),
            'description' => $job->getDescription(),
            'status'      => $job->getStatus(),
            'workplace'   => $job->getWorkplace(),
            'salary'      => $job->getSalary(),
        ];
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function delete(int $id)
    {
        $job = $this->jobRepository->find($id);

        if (is_null($job)) {
            throw new RecordNotFoundException;
        }

        $this->jobRepository->delete($job);
    }

    /**
     * @param array $filters
     * @return array
     */
    public function findBy(array $filters)
    {
        return $this->jobRepository->findBy($filters);
    }

    /**
     * @param $data
     * @param bool $register
     */
    private function validateData(&$data, bool $register = true)
    {
        if ($register) {
            Assert::keyExists($data, 'title', '"title" is required.');
            Assert::keyExists($data, 'description', '"description" is required.');
        }

        if (isset($data['title'])) {
            Assert::string($data['title'], '"title" is not a string.');
        }

        if (isset($data['description'])) {
            Assert::string($data['description'], '"description" is not a string.');
        }

        if (isset($data['status'])) {
            Assert::regex($data['status'], '/^off$|^on$/i', '"status" is not valid.');
        }

        if (isset($data['workplace'])) {
            Assert::string($data['workplace'], '"workplace" is not a string.');
        }

        if (isset($data['salary'])) {
            Assert::numeric($data['salary'], '"salary" is not a float.');
        }
    }
}