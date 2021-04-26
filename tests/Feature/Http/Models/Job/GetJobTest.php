<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\Job\CreateJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\CreateRecruiter;
use Tests\TestCase;
use App\Models\Job\GetJob;

class GetJobTest extends TestCase
{
    /**
     * @var array
     */
    private $requestData;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->requestData = [
            'title' => 'title test',
            'description' => 'description test',
            'status' => Job::JOB_STATUS_OPEN,
            'address' => 'address test',
            'salary' => 7500.90,
        ];

        parent::__construct($name, $data, $dataName);
    }

    public function test_get_job_success()
    {
        $recruiter = CreateRecruiter::create();

        $request = $this->generateRequest('POST');
        $job = CreateJob::store($request, $recruiter->id);

        $getJob = GetJob::getJobById($job->id);

        $this->assertInstanceOf(Job::class, $job);
        $this->assertEquals('title test', $getJob->title);
    }

    public function test_get_nonexistent_job()
    {
        $this->expectException(\Exception::class);
        GetJob::getJobById('non_existent_job');
    }

    private function generateRequest(string $method): Request
    {
        $request = new Request();
        $request->setMethod($method);
        $request->request->add($this->requestData);

        return $request;
    }
}
