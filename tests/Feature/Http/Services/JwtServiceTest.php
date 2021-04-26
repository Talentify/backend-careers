<?php

namespace Tests\Feature;

use App\Http\Services\JwtService;
use App\Models\Recruiter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Lindelius\JWT\Exception\JwtException;
use Tests\TestCase;

class JwtServiceTest extends TestCase
{
    public function test_generete_token()
    {
        $recruiter = new Recruiter();
        $recruiter->id = '123';

        $jwt = JwtService::generateToken($recruiter);

        $this->assertIsString($jwt);
    }

    public function test_decode_token()
    {
        $recruiter = new Recruiter();
        $recruiter->id = '123';

        $jwt = JwtService::generateToken($recruiter);
        $decodedToken = JwtService::decodeToken($jwt);

        $this->assertEquals('123', $decodedToken->id);
    }

    public function test_validate_valid_token()
    {
        $recruiter = new Recruiter();
        $recruiter->id = '123';

        $jwt = JwtService::generateToken($recruiter);
        $isValid = JwtService::validateToken($jwt);

        $this->assertTrue($isValid);
    }

    public function test_validate_invalid_token()
    {
        $recruiter = new Recruiter();
        $recruiter->id = '123';

        $jwt = JwtService::generateToken($recruiter);
        $jwt = $jwt.'invalidToken';

        $this->expectException(JwtException::class);
        $this->expectExceptionMessage('Invalid JWT signature.');
        JwtService::validateToken($jwt);
    }
}
