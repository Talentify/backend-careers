<?php 

namespace App\Service;

use App\DBAL\Types\StatusType;
use App\Entity\Address;
use App\Entity\Job;
use App\Repository\JobRepository;

class JobService {
    protected $repository;

    public function __construct(JobRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create (array $data)
    {
        $job = new Job();
        $job->setTitle($data['title']);
        $job->setDescription($data['description']);
        $job->setStatus($data['status']);
        $job->setSalary($data['salary'] ?? null);

        if (isset($data['workspace'])) {
            $address = new Address;
            $address->setStreet($data['workspace']['street'] ?? null);
            $address->setNumber($data['workspace']['number'] ?? null);
            $address->setCity($data['workspace']['city'] ?? null);
            $address->setState($data['workspace']['state'] ?? null);       
            $address->setPostcode($data['workspace']['postcode'] ?? null);       

            $job->setWorkspace($address);
        }

        return $this->repository->save($job);
    }

    public function getActive()
    {
//        var_dump($this->repository->findAll());exit;
        return $this->repository->findBy([
            'status' => StatusType::ACTIVE
        ]);
    }
}
