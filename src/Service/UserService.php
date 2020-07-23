<?php

namespace App\Service;

use App\Domain\Repositories\UserRepositoryInterface;
use App\Domain\ValuesObjects\UserList;

class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    protected $repository;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return UserList|null
     */
    public function list()
    {
        return $this->repository->index();
    }

    /**
     * @param array $data
     * @return UserList|null
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }
}