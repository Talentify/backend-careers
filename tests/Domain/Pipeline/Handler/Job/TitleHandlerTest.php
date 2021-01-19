<?php


namespace App\Tests\Domain\Pipeline\Handler\Job;


use App\Domain\Model\Job;
use App\Domain\Pipeline\Handler\Job\TitleHandler;
use App\Infrastructure\Exception\Pipeline\Validator\InvalidField;
use PHPUnit\Framework\TestCase;

class TitleHandlerTest extends TestCase
{

    /**
     */
    public function testRequired()
    {
        $this->expectException(InvalidField::class);

        $job = new Job();

        (new TitleHandler())($job);
    }

    /**
     */
    public function testLenght()
    {
        $this->expectException(InvalidField::class);

        $job = new Job();
        $job->setTitle(str_pad('A', 257, 'A', STR_PAD_BOTH));

        (new TitleHandler())($job);
    }
}