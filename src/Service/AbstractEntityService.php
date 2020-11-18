<?php
namespace App\Service;

use App\Interfaces\DoctrineEntityInterface;
use App\Interfaces\DoctrineEntityServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

abstract class AbstractEntityService implements DoctrineEntityServiceInterface
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @return string
     */
    abstract public function getEntityClass(): string;

    /**
     * @param EntityManagerInterface $entityManager
     * @return DoctrineEntityServiceInterface
     */
    public function setEntityManager(EntityManagerInterface $entityManager): DoctrineEntityServiceInterface
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     * @param string $entityClass
     * @return EntityRepository
     */
    public function getEntityRepository(string $entityClass): EntityRepository
    {
        return $this->entityManager->getRepository($entityClass);
    }

    /**
     * @param DoctrineEntityInterface $entity
     * @return DoctrineEntityInterface
     */
    public function persist(DoctrineEntityInterface $entity): DoctrineEntityInterface
    {
        $this->entityManager->persist($entity);
        return $entity;
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     * @return array
     * @throws NoResultException
     */
    public function find(array $criteria, ?array $orderBy, ?int $limit, ?int $offset): array
    {
        $results = $this->getEntityRepository($this->getEntityClass())->findBy(...func_get_args());
        if (count($results) === 0) {
            throw new NoResultException();
        }
        return $results;
    }
}