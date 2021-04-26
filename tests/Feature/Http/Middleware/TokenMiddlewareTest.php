<?php

namespace Tests\Feature;

use App\Http\Middleware\Token;
use App\Http\Services\JwtService;
use App\Models\Recruiter;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;
use Illuminate\Http\Request;

class TokenMiddlewareTest extends TestCase
{

    public function test_token_invalid()
    {
        $request = new Request();
        $request->setMethod('POST');

        $request->headers->set('Authorization','invalidToken');

        $middleware = new Token();

        $response = $middleware->handle($request, function ($req) {
        });

        $decodedResponse = json_decode($response->getContent());

        $this->assertEquals(403, $response->getStatusCode());

        $this->assertEquals('Unexpected number of JWT segments.', $decodedResponse->message);
    }

    public function test_token_null()
    {
        $request = new Request();
        $request->setMethod('POST');

        $request->headers->set('Authorization',null);

        $middleware = new Token();

        $response = $middleware->handle($request, function ($req) {
        });

        $decodedResponse = json_decode($response->getContent());

        $this->assertEquals(403, $response->getStatusCode());

        $this->assertEquals('Unsent Authorization.', $decodedResponse->message);
    }

    public function test_token_false()
    {
        $request = new Request();
        $request->setMethod('POST');

        $request->headers->set('Authorization',false);

        $middleware = new Token();

        $response = $middleware->handle($request, function ($req) {
        });

        $decodedResponse = json_decode($response->getContent());

        $this->assertEquals(403, $response->getStatusCode());

        $this->assertEquals('Unsent Authorization.', $decodedResponse->message);
    }

    public function test_token_valid()
    {
        $request = new Request();
        $request->setMethod('POST');
        $recruiter = new Recruiter();
        $recruiter->id = '123';

        $token = JwtService::generateToken($recruiter);
        $request->headers->set('Authorization', $token);

        $middleware = new Token();

        $response = $middleware->handle($request, function ($req) {
        });

        $this->assertEquals(null, $response);
    }

}
