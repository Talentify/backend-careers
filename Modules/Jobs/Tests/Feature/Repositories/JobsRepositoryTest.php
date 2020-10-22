<?php


namespace Modules\Jobs\Tests\Feature\Repositories;

use Illuminate\Foundation\Testing\WithFaker;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Repositories\JobsRepositoryInterface;
use Tests\TestCase;

class JobsRepositoryTest extends TestCase
{
    use WithFaker;

    public function testCanCreateNewJobWithValidData()
    {
        $requestBody = Job::factory()->definition();

        $jobsRepository = $this->app->get(JobsRepositoryInterface::class);

        $job = $jobsRepository->createNewJob($requestBody);

        $this->assertDatabaseHas('jobs', $job->getAttributes());
    }

    /**
     * @dataProvider invalidJobDataProvider
     */
    public function testCanNotCreateJobWithInvalidData(string $columnName, $data)
    {
        $requestBody = [
            $columnName => $data
        ];

        $jobsRepository = $this->app->get(JobsRepositoryInterface::class);

        $job = $jobsRepository->createNewJob($requestBody);

        $this->assertNull($job);

        $this->assertArrayHasKey($columnName, $jobsRepository->getErrors()->toArray());
    }

    public function invalidJobDataProvider()
    {
        return [
            'without title' => [
                'title',
                null
            ],
            'invalid title' => [
                'title',
                true
            ],
            'without description' => [
                'description',
                null
            ],
            'invalid description' => [
                'title',
                10
            ],
            'invalid status' => [
                'status',
                'invalid status'
            ]
        ];
    }
}
