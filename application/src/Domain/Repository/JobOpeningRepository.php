<?php

namespace App\Domain\Repository;

use App\Domain\JobOpening\Entity\JobOpening;

interface JobOpeningRepository
{
    public function list();

    public function save(JobOpening $jobOpening);
}