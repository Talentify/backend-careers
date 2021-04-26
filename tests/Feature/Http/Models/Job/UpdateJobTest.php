<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\Job\CreateJob;
use App\Models\Job\UpdateJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\CreateRecruiter;
use Tests\TestCase;

class UpdateJobTest extends TestCase
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

    public function test_update_job_success()
    {
        $recruiter = CreateRecruiter::create();

        $request = $this->generateRequest('POST');
        $job = CreateJob::store($request, $recruiter->id);

        $this->requestData['title'] = 'updated title';
        $request = $this->generateRequest('PUT');

        $job = UpdateJob::update($request, $job->id);

        $this->assertInstanceOf(Job::class, $job);
        $this->assertEquals('updated title', $job->title);
    }

    public function test_update_job_nonexistent()
    {
        $this->requestData['title'] = 'updated title';
        $request = $this->generateRequest('PUT');

        $this->expectException(\Exception::class);
        UpdateJob::update($request, 'no_register_job');
    }

    private function generateRequest(string $method): Request
    {
        $request = new Request();
        $request->setMethod($method);
        $request->request->add($this->requestData);

        return $request;
    }
}
