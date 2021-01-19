<?php


namespace App\Tests\Domain\Pipeline\Handler\Job;


use App\Domain\Model\Job;
use App\Domain\Pipeline\Handler\Job\StatusHandler;
use App\Domain\Pipeline\Handler\Job\TitleHandler;
use App\Infrastructure\Exception\Pipeline\Validator\InvalidField;
use PHPUnit\Framework\TestCase;

class StatusHandlerTest extends TestCase
{

    /**
     */
    public function testRequired()
    {
        $this->expectException(InvalidField::class);

        $job = new Job();
        $job->setStatus(0);

        (new StatusHandler())($job);
    }

    /**
     */
    public function testLenght()
    {
        $this->expectException(InvalidField::class);

        $job = new Job();
        $job->setStatus(999);

        (new StatusHandler())($job);
    }
}