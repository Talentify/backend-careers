<?php


namespace App\Domain\Repositories;


use App\Domain\Entity\Vacancy;
use App\Domain\ValuesObjects\VacancyList;

interface VacancyRepositoryInterface
{
    /**
     * @param int $id
     * @return Vacancy
     */
    public function getById(int $id): Vacancy;

    /**
     * @return VacancyList
     */
    public function index(): VacancyList;

    /**
     * @return VacancyList
     */
    public function active(): VacancyList;
}