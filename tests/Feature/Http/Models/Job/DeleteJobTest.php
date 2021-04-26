<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\Job\CreateJob;
use App\Models\Job\DeleteJob;
use App\Models\Job\GetJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\CreateRecruiter;
use Tests\TestCase;

class DeleteJobTest extends TestCase
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

    public function test_delete_job_success()
    {
        $recruiter = CreateRecruiter::create();

        $request = $this->generateRequest('POST');
        $job = CreateJob::store($request, $recruiter->id);

        DeleteJob::delete($job->id);

        $this->expectException(\Exception::class);
        GetJob::getJobById($job->id);
    }

    public function test_delete_job_unexistent()
    {
        $this->expectException(\Exception::class);
        DeleteJob::delete('unexistent_job');
    }

    private function generateRequest(string $method): Request
    {
        $request = new Request();
        $request->setMethod($method);
        $request->request->add($this->requestData);

        return $request;
    }
}
