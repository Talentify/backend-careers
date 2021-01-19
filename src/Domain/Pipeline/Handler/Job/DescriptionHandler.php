<?php

namespace App\Domain\Pipeline\Handler\Job;

use App\Domain\Model\Job;
use App\Infrastructure\Exception\Pipeline\Validator\InvalidField;

class DescriptionHandler
{
    private const MAX = 10000;

    public function __invoke(Job $job)
    {
        $description = $job->getDescription();

        if (!$description) {
            throw new InvalidField('Job description is required');
        }

        if (strlen($description) > self::MAX) {
            throw new InvalidField(sprintf('Job description contain long text. Max lenght is %s', self::MAX));
        }
    }
}