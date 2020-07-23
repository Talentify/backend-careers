<?php

namespace App\Service;

use App\Domain\Entity\Vacancy;
use App\Domain\Repositories\VacancyRepositoryInterface;
use App\Domain\ValuesObjects\VacancyList;
use App\Repository\VacancyRepository;

class VacancyService
{
    /**
     * @var VacancyRepository
     */
    protected $repository;

    /**
     * UserService constructor.
     * @param VacancyRepositoryInterface $repository
     */
    public function __construct(VacancyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return VacancyList
     */
    public function list()
    {
        return $this->repository->index();
    }

    /**
     * @return VacancyList
     */
    public function listActive()
    {
        return $this->repository->active();
    }

    /**
     * @param int $id
     * @return Vacancy
     */
    public function get(int $id)
    {
        return $this->repository->getById($id);
    }

    /**
     * @param array $data
     * @return Vacancy
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }
}