<?php

namespace App\User\Persistence\Repository;

use App\User\Domain\Entity\User;
use App\User\Domain\Exceptions\RecordExistException;
use App\User\Domain\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UserOrmRepository
 * @package App\User\Persistence\Repository
 */
class UserOrmRepository implements UserRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * UserOrmRepository constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em;
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->entityManager
            ->createQueryBuilder()
            ->select('u.email, u.id, u.roles')
            ->from(User::class, 'u')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param User $user
     * @return User
     * @throws \Exception
     */
    public function save(User $user): User
    {
        $exist = $this->findBy(['email' => $user->getEmail()]);

        if ($exist) {
            throw new RecordExistException();
        }

        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return $user;
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
            ->select('u')
            ->from(User::class, 'u')
            ->where('u.id = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param User $user
     */
    public function delete(User $user): void
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    /**
     * @param array $filters
     * @return array
     */
    public function findBy(array $filters = []): array
    {
        $query = $this->entityManager
            ->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u');

        if (isset($filters['email'])) {
            $query->andWhere($query->expr()->like('u.email',$query->expr()->literal('%' . $filters['email'] . '%')));
        }

        return $query->getQuery()->getArrayResult();
    }

    /**
     * @param User $user
     * @return User
     * @throws \Exception
     */
    public function update(User $user): User
    {
        try {
            $this->entityManager->flush();
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return $user;
    }
}