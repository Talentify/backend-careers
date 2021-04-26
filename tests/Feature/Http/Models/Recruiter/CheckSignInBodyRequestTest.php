<?php

namespace Tests\Feature;

use App\Models\Recruiter\CheckSignInBodyRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreateRequestTrait;
use Tests\TestCase;

class CheckSignInBodyRequestTest extends TestCase
{
    use CreateRequestTrait;

    /**
     * @var array
     */
    private $requestData;

    use CreateRequestTrait;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->requestData = [
            'login' => 'test.alpha',
            'password' => '123456'
        ];

        parent::__construct($name, $data, $dataName);
    }

    public function test_valid_body()
    {
        $request = $this->create('POST', $this->requestData);
        $result = CheckSignInBodyRequest::check($request);

        $this->assertTrue($result);
    }

    public function test_invalid_body()
    {
        $this->requestData = [];

        $request = $this->create('POST', $this->requestData);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The field login is required');
        CheckSignInBodyRequest::check($request);
    }
}
