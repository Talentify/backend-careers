<?php

namespace App\Tests\Domain\Model;

use App\Domain\Enum\Job\StatusEnum;
use App\Domain\Model\Job;
use PHPUnit\Framework\TestCase;

class JobTest extends TestCase
{

    public function testTitle()
    {
        $job = new Job();
        $job->setTitle(get_class($job));

        $this->assertEquals(get_class($job), $job->getTitle());
        $this->assertRegExp('#Job$#', $job->getTitle());
    }

    public function testDescription()
    {
        $job = new Job();
        $job->setDescription(get_class($job));

        $this->assertEquals(get_class($job), $job->getDescription());
        $this->assertRegExp('#Job$#', $job->getDescription());
    }

    public function testStatus()
    {
        $job = new Job();
        $job->setStatus(StatusEnum::OPEN);

        $this->assertEquals(StatusEnum::OPEN, $job->getStatus());
        $this->assertIsInt($job->getStatus());
        $this->assertContains($job->getStatus(), array_keys(StatusEnum::ALL));
    }

    public function testWorkplace()
    {
        $job = new Job();
        $job->setWorkplace(get_class($job));

        $this->assertEquals(get_class($job), $job->getWorkplace());
        $this->assertIsString($job->getWorkplace());
    }

    public function testSalary()
    {
        $job = new Job();
        $job->setSalary(1.12);

        $this->assertEquals(1.12, $job->getSalary());
        $this->assertIsFloat($job->getSalary());
    }
}