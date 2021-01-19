<?php

namespace App\Infrastructure\Service\Validator;

use App\Domain\Model\Job;
use App\Domain\Pipeline\Handler\Job\{
    DescriptionHandler,
    StatusHandler,
    TitleHandler
};
use App\Infrastructure\Pipeline\Runner;
use Doctrine\Common\Collections\Collection;

class JobValidatorService
{
    public function validate(Job $job): Collection
    {
        $pipeline = new Runner();

        $pipeline->add(TitleHandler::class);
        $pipeline->add(DescriptionHandler::class);
        $pipeline->add(StatusHandler::class);

        return $pipeline->run($job);
    }
}