<?php
namespace App\Interfaces;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

interface DoctrineEntityServiceInterface
{
    /**
     * @param EntityManagerInterface $entityManager
     * @return DoctrineEntityServiceInterface
     */
    public function setEntityManager(EntityManagerInterface $entityManager): DoctrineEntityServiceInterface;

    /**
     * @param string $entityClass
     * @return EntityRepository
     */
    public function getEntityRepository(string $entityClass): EntityRepository;

    /**
     * @param DoctrineEntityInterface $entity
     * @return DoctrineEntityInterface
     */
    public function persist(DoctrineEntityInterface $entity): DoctrineEntityInterface;

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     * @return array
     */
    public function find(array $criteria, ?array $orderBy, ?int $limit, ?int $offset): array;
}