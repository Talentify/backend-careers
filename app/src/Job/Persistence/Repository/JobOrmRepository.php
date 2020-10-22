<?php

namespace App\Job\Persistence\Repository;

use App\Job\Domain\Exceptions\RecordExistException;
use App\Job\Domain\Repository\JobRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Job\Domain\Entity\Job;

/**
 * Class JobOrmRepository
 * @package App\Job\Persistence\Repository
 */
class JobOrmRepository implements JobRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em;
    }

    /**
     * @param Job $job
     * @return Job
     * @throws \Exception
     */
    public function save(Job $job): Job
    {
        $exist = $this->findBy(['title' => $job->getTitle()]);

        if ($exist) {
            throw new RecordExistException();
        }

        try {
            $this->entityManager->persist($job);
            $this->entityManager->flush();
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return $job;
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function find(int $id)
    {
        return $this->entityManager
            ->createQueryBuilder()
            ->select('j')
            ->from(Job::class, 'j')
            ->where('j.id = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param Job $job
     */
    public function delete(Job $job): void
    {
        $this->entityManager->remove($job);
        $this->entityManager->flush();
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->entityManager
            ->createQueryBuilder()
            ->select('j')
            ->from(Job::class, 'j')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param array $filters
     * @return array
     */
    public function findBy(array $filters = []): array
    {
        $query = $this->entityManager
            ->createQueryBuilder()
            ->select('j')
            ->from(Job::class, 'j');

        if (isset($filters['title'])) {
            $query->andWhere($query->expr()->like('j.title',$query->expr()->literal('%' . $filters['title'] . '%')));
        }

        if (isset($filters['workplace'])) {
            $query->andWhere($query->expr()->like('j.workplace',$query->expr()->literal('%' . $filters['workplace'] . '%')));
        }

        return $query->getQuery()->getArrayResult();
    }

    /**
     * @param Job $job
     * @return Job
     * @throws \Exception
     */
    public function update(Job $job): Job
    {
        try {
            $this->entityManager->flush();
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return $job;
    }
}
