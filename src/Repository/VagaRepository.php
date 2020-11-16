<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Vaga;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vaga|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vaga|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vaga[]    findAll()
 * @method Vaga[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VagaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vaga::class);
    }

    // /**
    //  * @return Vaga[] Returns an array of Vaga objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vaga
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
