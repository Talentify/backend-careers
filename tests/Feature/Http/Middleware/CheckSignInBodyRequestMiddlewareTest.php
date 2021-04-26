<?php

namespace Tests\Feature;

use App\Http\Middleware\CheckJobBodyRequestMiddleware;
use App\Http\Middleware\CheckSignInBodyRequestMiddleware;
use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreateRequestTrait;
use Tests\TestCase;

class CheckSignInBodyRequestMiddlewareTest extends TestCase
{
    use CreateRequestTrait;

    /**
     * @var array
     */
    private $requestData;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->requestData = [
            'login' => 'user.one',
            'password' => '123456',
        ];

        parent::__construct($name, $data, $dataName);
    }

    public function test_valid_request()
    {
        $request = $this->create('POST', $this->requestData);

        $middleware = new CheckSignInBodyRequestMiddleware();

        $response = $middleware->handle($request, function($req) {});

        $this->assertNull($response);
    }

    public function test_invalid_request()
    {
        $this->requestData = [];

        $request = $this->create('POST', $this->requestData);

        $middleware = new CheckSignInBodyRequestMiddleware();

        $response = $middleware->handle($request, function($req) {});

        $this->assertEquals('The field login is required', $response->getData()->message);
        $this->assertEquals(400, $response->getStatusCode());
    }
}
