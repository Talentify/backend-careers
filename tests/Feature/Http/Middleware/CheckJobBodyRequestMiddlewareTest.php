<?php

namespace Tests\Feature;

use App\Http\Middleware\CheckJobBodyRequestMiddleware;
use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class CheckJobBodyRequestMiddlewareTest extends TestCase
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

    public function test_valid_request()
    {
        $request = $this->generateRequest('POST');

        $middleware = new CheckJobBodyRequestMiddleware();

        $response = $middleware->handle($request, function($req) {});

        $this->assertNull($response);
    }

    public function test_invalid_request()
    {
        $this->requestData = [];

        $request = $this->generateRequest('POST');

        $middleware = new CheckJobBodyRequestMiddleware();

        $response = $middleware->handle($request, function($req) {});

        $this->assertEquals('The field title is required', $response->getData()->message);
        $this->assertEquals(400, $response->getStatusCode());
    }

    private function generateRequest(string $method): Request
    {
        $request = new Request();
        $request->setMethod($method);
        $request->request->add($this->requestData);

        return $request;
    }

}
