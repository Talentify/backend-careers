<?php

namespace Tests\Feature;

use App\Http\Middleware\CheckSignInBodyRequestMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreateCompany;
use Tests\CreateRequestTrait;
use Tests\TestCase;

class CheckSignUpBodyRequestMiddleware extends TestCase
{
    use CreateRequestTrait;

    /**
     * @var array
     */
    private $requestData;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $company = CreateCompany::create();

        $this->requestData = [
            'name' => 'User One',
            'login' => 'user.one',
            'password' => '123456',
            'company_id' => $company->id,
        ];

        parent::__construct($name, $data, $dataName);
    }

    public function test_valid_request()
    {
        $request = $this->create('POST', $this->requestData);

        $middleware = new CheckSignUpBodyRequestMiddleware();

        $response = $middleware->handle($request, function($req) {});

        $this->assertNull($response);
    }

    public function test_invalid_request()
    {
        $this->requestData = [];

        $request = $this->create('POST', $this->requestData);

        $middleware = new CheckSignUpBodyRequestMiddleware();

        $response = $middleware->handle($request, function($req) {});

        $this->assertEquals('The field name is required', $response->getData()->message);
        $this->assertEquals(400, $response->getStatusCode());
    }
}
