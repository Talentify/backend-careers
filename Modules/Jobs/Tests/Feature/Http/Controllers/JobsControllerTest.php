<?php


namespace Modules\Jobs\Tests\Feature\Http\Controllers;


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Jobs\Entities\Job;
use Tests\TestCase;

class JobsControllerTest extends TestCase
{
    use RefreshDatabase;

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

        $requestBody = Job::factory()->definition();

        $response = $this->actingAs($user)->post('/api/jobs', $requestBody);

        $response->assertStatus(200);
    }
}
