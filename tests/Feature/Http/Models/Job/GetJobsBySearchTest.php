<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\Job\CreateJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreateCompany;
use Tests\CreateRecruiter;
use Tests\CreateRequestTrait;
use Tests\TestCase;

class GetJobsBySearchTest extends TestCase
{
    use CreateRequestTrait;

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

    public function test_valid_search()
    {
        $request = $this->create('POST', $this->requestData);

        $recruiter = CreateRecruiter::create();
        CreateJob::store($request, $recruiter->id);

        $searchResult = Job\GetJob::getJobBySearch('address', 'address test');

        $this->assertEquals($this->requestData['address'], $searchResult[0]->address);
    }

    public function test_valid_title_search_using_like()
    {
        $request = $this->create('POST', $this->requestData);

        $recruiter = CreateRecruiter::create();
        CreateJob::store($request, $recruiter->id);

        $searchResult = Job\GetJob::getJobBySearch('title', 'test');

        $this->assertEquals($this->requestData['address'], $searchResult[0]->address);
    }

    public function test_no_result_search()
    {
        $request = $this->create('POST', $this->requestData);

        $recruiter = CreateRecruiter::create();
        CreateJob::store($request, $recruiter->id);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('No results for this search!');

        Job\GetJob::getJobBySearch('address', 'different address');
    }

}
