<?php

namespace Tests\Feature;

use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\Models\Job\CheckJobBodyRequest;

class CheckJobBodyRequestTest extends TestCase
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
            'recruiter_id' => '1234',
        ];

        parent::__construct($name, $data, $dataName);
    }

    public function test_valid_body()
    {
        $request = $this->generateRequest('POST');
        $result = CheckJobBodyRequest::check($request);

        $this->assertTrue($result);
    }

    public function test_invalid_body()
    {
        $this->requestData = [];

        $request = $this->generateRequest('POST');

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The field title is required');
        CheckJobBodyRequest::check($request);
    }

    public function test_empty_field_title()
    {
        $this->requestData['title'] = null;

        $request = $this->generateRequest('POST');

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid field: title');
        CheckJobBodyRequest::check($request);
    }

    private function generateRequest(string $method): Request
    {
        $request = new Request();
        $request->setMethod($method);
        $request->request->add($this->requestData);

        return $request;
    }
}
