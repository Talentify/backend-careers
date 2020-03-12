<?php

namespace App\Repository;

use App\Entity\JobOpportunity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method JobOpportunity|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobOpportunity|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobOpportunity[]    findAll()
 * @method JobOpportunity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobOpportunityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobOpportunity::class);
    }

    // /**
    //  * @return JobOpportunity[] Returns an array of JobOpportunity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JobOpportunity
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
