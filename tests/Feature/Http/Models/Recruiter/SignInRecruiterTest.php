<?php

namespace Tests\Feature;

use App\Models\Recruiter;
use App\Models\Recruiter\SignInRecruiter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\CreateRecruiter;
use Tests\CreateRequestTrait;
use Tests\TestCase;

class SignInRecruiterTest extends TestCase
{
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

    public function test_valid_signIn()
    {
        CreateRecruiter::create();
        $request =  $this->create('POST', $this->requestData);

        $recruiter = SignInRecruiter::signIn($request);

        $this->assertInstanceOf(Recruiter::class, $recruiter);
    }

    public function test_invalid_signIn()
    {
        $this->requestData = [
            'login' => 'invalid',
            'password' => 'invalid'
        ];
        CreateRecruiter::create();
        $request = $this->create('POST', $this->requestData);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid credential');
        SignInRecruiter::signIn($request);
    }

}
