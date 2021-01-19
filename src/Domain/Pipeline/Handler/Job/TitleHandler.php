<?php

namespace App\Domain\Pipeline\Handler\Job;

use App\Domain\Model\Job;
use App\Infrastructure\Exception\Pipeline\Validator\InvalidField;

class TitleHandler
{
    private const MAX = 256;

    public function __invoke(Job $job)
    {
        $title = $job->getTitle();

        if (!$title) {
            throw new InvalidField('Job title is required');
        }

        if (strlen($title) > self::MAX) {
            throw new InvalidField(sprintf('Job title contain long text. Max lenght is %s', self::MAX));
        }
    }
}