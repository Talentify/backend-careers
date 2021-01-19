<?php

namespace App\Infrastructure\Service;

use Doctrine\ORM\Tools\Pagination\Paginator;
use App\Domain\{Enum\Job\StatusEnum, Model\Job, Service\JobServiceInterface};
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class JobServiceRepository extends ServiceEntityRepository implements JobServiceInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Job::class);
    }

    public function findAllActives(): array
    {
        return $this->findBy(['status' => StatusEnum::OPEN]);
    }

    public function findInPaginator(int $page = 1, ?int $status = null): array
    {
        $maxResult = 10;
        $offset = ($page - 1) * $maxResult;
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select(['a']);
        $queryBuilder->from(Job::class, 'a');
        $expression = $queryBuilder->expr();

        $queryBuilder->setMaxResults($maxResult);
        $queryBuilder->setFirstResult($offset);

        if (!empty($status)) {
            $queryBuilder->andWhere($expression->eq('a.status', ':status'));
            $queryBuilder->setParameter('status', $status);
        }

        $paginator = new Paginator($queryBuilder);

        return [
            'count' => $paginator->count(),
            'limit' => $queryBuilder->getMaxResults(),
            'result' => $paginator->getQuery()->getResult(),
        ];
    }

    public function remove(Job $job): void
    {
        $this->getEntityManager()->remove($job);
        $this->getEntityManager()->flush();
    }

    public function save(Job $job): void
    {
        $this->getEntityManager()->persist($job);
        $this->getEntityManager()->flush();
    }

}