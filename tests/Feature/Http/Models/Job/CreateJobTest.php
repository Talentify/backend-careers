<?php

namespace Tests\Feature;

use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Tests\CreateCompany;
use Tests\CreateRecruiter;
use Tests\TestCase;
use App\Models\Job\CreateJob;

class CreateJobTest extends TestCase
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

    public function test_create_job_success()
    {
        $recruiter = CreateRecruiter::create();

        $request = $this->generateRequest('POST');
        $job = CreateJob::store($request, $recruiter->id);

        $this->assertInstanceOf(Job::class, $job);
        $this->assertEquals('title test', $job->title);
    }

    public function test_create_job_unregister_company()
    {
        $request = $this->generateRequest('POST');

        $this->expectException(\Exception::class);
        CreateJob::store($request, 'not_register_id');
    }

    private function generateRequest(string $method): Request
    {
        $request = new Request();
        $request->setMethod($method);
        $request->request->add($this->requestData);

        return $request;
    }

}
