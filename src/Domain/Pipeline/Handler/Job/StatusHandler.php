<?php

namespace App\Domain\Pipeline\Handler\Job;

use App\Domain\Enum\Job\StatusEnum;
use App\Domain\Model\Job;
use App\Infrastructure\Exception\Pipeline\Validator\InvalidField;

class StatusHandler
{
    private const MAX = 10000;

    public function __invoke(Job $job)
    {
        $status = $job->getStatus();

        if (!$status) {
            throw new InvalidField('Job status is required');
        }

        if (!StatusEnum::translate($status)) {
            throw new InvalidField(
                sprintf('Job status is not valid. Choice a list ', implode(', ', StatusEnum::ALL))
            );
        }
    }
}