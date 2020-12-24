<?php

namespace App\Application;

use App\Domain\JobOpening\DTO\JobOpening;
use App\Domain\JobOpening\JobOpeningService;

class JobOpeningCommand
{

    private $jobOpeningService;

    public function __construct(JobOpeningService $jobOpeningService)
    {
        $this->jobOpeningService = $jobOpeningService;
    }

    public function createJobOpening(JobOpening $jobOpening)
    {
        $this->jobOpeningService->create($jobOpening);
    }

    public function listJobOpenings()
    {
        return $this->jobOpeningService->list();
    }
}