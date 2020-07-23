<?php

namespace App\Factories;

use App\Domain\Entity\Vacancy;

class VacancyFactory
{
    /**
     * @param $id
     * @param $title
     * @param $description
     * @param $workplace
     * @param $salary
     * @param $status
     * @return Vacancy
     */
    public static function make($id, $title, $description, $workplace, $salary, $status)
    {
        return new Vacancy($id, $title, $description, $workplace, $salary, $status);
    }
}