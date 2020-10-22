<?php


namespace Modules\Jobs\Tests\Feature\Http\Controllers;


use App\Models\User;
use Tests\TestCase;
use Tymon\JWTAuth\JWTAuth;

class JobsControllerTest extends TestCase
{
    public function testGuestUserCanAccessListJobsEndpoint()
    {
        $response = $this->get('/api/jobs', ['Accept' => 'application/json']);

        $response->assertStatus(200);

        $this->assertNotNull($response->json('data'));
    }

    public function testGuestUserCanNotAccessCreateNewJobEndpoint()
    {
        $response = $this->post('/api/jobs', [], ['accept' => 'application/json']);

        $response->assertStatus(401);
    }

    public function testAuthenticatedUserCanAccessCreateNewJobEndpoint()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/api/jobs');

        $response->assertStatus(200);
    }
}
