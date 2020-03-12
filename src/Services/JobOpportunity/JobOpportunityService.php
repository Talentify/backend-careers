<?php


namespace App\Services\JobOpportunity;


use App\Entity\JobOpportunity;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\JobOpportunityRepository;

class JobOpportunityService
{
    const STATUS_PUBLISHED = 'publised';
    const STATUS_CANCELED = 'canceled';

    private JobOpportunityRepository $repository;

    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager, JobOpportunityRepository $repository)
    {
        $this->manager = $manager;
        $this->repository = $repository;
    }

    public function save(JobOpportunity $jobOpportunity) : JobOpportunity
    {
        $this->manager->persist($jobOpportunity);
        $this->manager->flush();
        return $jobOpportunity;
    }

    public function create(JobOpportunity $jobOpportunity) : JobOpportunity
    {
        $jobOpportunity->setStatus(self::STATUS_PUBLISHED);
        return $this->save($jobOpportunity);
    }

    public function cancel(JobOpportunity $jobOpportunity) : JobOpportunity
    {
        $jobOpportunity->setStatus(self::STATUS_CANCELED);
        return $this->save($jobOpportunity);
    }

    public function findAll() :array
    {
        return $this->repository->findAll();
    }


}