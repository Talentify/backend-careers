<?php

namespace App\Infra\Repository;

use App\Domain\JobOpening\Entity\JobOpening;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Domain\Repository\JobOpeningRepository as JobOpeningRepositoryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobOpeningRepository extends ServiceEntityRepository implements JobOpeningRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobOpening::class);
    }

    public function save(JobOpening $jobOpening)
    {
        $this->_em->persist($jobOpening);
        $this->_em->flush();
    }

    public function list()
    {
        return $this->createQueryBuilder('job')
            ->where('job.status = :status')
            ->setParameter('status', JobOpening::STATUS_ACTIVE)
            ->getQuery()
            ->getResult();
    }
}
