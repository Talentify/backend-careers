<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\Job;
use App\Models\User;

class JobsTest extends TestCase
{
    use DatabaseTransactions;
    
    public function testCreateJobtWithoutMiddleware() : void
    {
        $data = [
            'title' => "New Job",
            'description' => "This is a job"
        ];

        $this->json('POST', '/api/jobs', $data);

        $this->assertEquals(401, $this->response->status());
        $this->assertEquals('Unauthorized.', $this->response->content());
    }

    public function testCreateJobWithMiddleware() : void
    {
        $data = [
            'title' => "New Job",
            'description' => "This is a job"
        ];

        $this->call('POST', 'api/users', [
            'name' => 'Joe Test',
            'email' => 'emailtest@test.php.unit',
            'password' => 'testpass123'
        ]);

        $token = $this->call('POST', "/api/auth/login",  [
            'email' => 'emailtest@test.php.unit',
            'password' => 'testpass123'
        ]);

        $this->json('POST', "/api/jobs/", $data, ['Authorization' => $token['access_token']]);
        $this->assertEquals(201, $this->response->status());
        $this->seeJsonStructure([
            'title', 'description', 'id'
        ]);
    }
    
    public function testGettingAllJobs() : void
    {
        $response = $this->call('GET', '/api/jobs');
        $this->assertEquals(200, $response->status());
    }

    public function testGettingJobById() : void
    {
        $response = $this->call('GET', "/api/jobs/1");

        $this->assertContains($response->status(), [200, 204]);
    }

    public function testEditJobWithoutMiddleware() : void
    {
        $data = [
            'title' => 'Title',
            'description' => 'Description',
        ];

        $this->call('PUT', "/api/jobs/1", $data);

        $this->assertEquals(401, $this->response->status());
    }
}
