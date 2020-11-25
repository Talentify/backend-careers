<?php

namespace Tests\Unit\Domain\Jobs;

use Domain\Jobs\Job;
use Domain\Jobs\Status;
use PHPUnit\Framework\TestCase;

class JobTest extends TestCase
{
    public function testCreateJob()
    {
        $job = new Job([
            'title' => 'Desenvolver PHP',
            'description' => 'Lorem Ipsum...',
            'status' => 'active'
        ]);

        $this->assertInstanceOf(Job::class, $job);

        $this->assertEquals('Desenvolver PHP', $job->title);
        $this->assertEquals('Lorem Ipsum...', $job->description);
        $this->assertEquals(Status::ACTIVE, $job->status);
        $this->assertEquals(null, $job->salary);
    }

    public function testCreateJobWithSalary()
    {
        $job = new Job([
            'title' => 'Back-end develolper',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sit amet elit sit amet metus lobortis fermentum vel et nisl. Proin posuere, velit vitae aliquet hendrerit, massa arcu rhoncus neque, ac tristique eros leo tincidunt augue. Maecenas id quam quis ligula vestibulum ornare maximus eget lectus. Donec quis erat mollis, dapibus justo porttitor, fermentum sapien.',
            'status' => 'active',
            'salary' => 11024.94
        ]);

        $this->assertInstanceOf(Job::class, $job);

        $this->assertEquals('Back-end develolper', $job->title);
        $this->assertEquals(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sit amet elit sit amet metus lobortis fermentum vel et nisl. Proin posuere, velit vitae aliquet hendrerit, massa arcu rhoncus neque, ac tristique eros leo tincidunt augue. Maecenas id quam quis ligula vestibulum ornare maximus eget lectus. Donec quis erat mollis, dapibus justo porttitor, fermentum sapien.',
            $job->description
        );
        $this->assertEquals(Status::ACTIVE, $job->status);
        $this->assertEquals(11024.94, $job->salary);
        $this->assertIsNumeric($job->salary);
    }
}
