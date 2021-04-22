<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\Recruiter;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JobFeatureTest extends TestCase
{
    use RefreshDatabase;

    private $token;
    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        // configure the jwt and refresh expires to only 1 minute because it's a test.
        config(['jwt.ttl' => 1, 'refresh_ttl' => 1]);

        // create a user
        $this->user = factory(User::class)->create();

        // generate a JWT Token from user inserted in DB and save in $token property
        $this->token = JWTAuth::fromUser($this->user);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_list_jobs()
    {
        factory(Job::class)->create([
            'recruiter_id'=> factory(Recruiter::class)
        ]);

        $response = $this->get('api/v1/jobs', ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'title', 'description', 'status', 'address', 'salary', 'company', 'recruiter_id','created_at',
                        'updated_at'
                    ]
                ]
            ]);

    }

    public function test_it_can_show_a_job()
    {
       $job = factory(Job::class)->create([
            'recruiter_id'=> factory(Recruiter::class)
       ]);

        $response = $this->get('api/v1/jobs/' . $job->id, ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJsonStructure([
                'id', 'title', 'description', 'status', 'address', 'salary', 'company', 'recruiter_id','created_at',
                'updated_at'
            ]);
    }

    public function test_it_cant_show_a_job_with_nonexistent_id()
    {
        // create 10 jobs
        factory(Job::class)->create([
            'recruiter_id'=> factory(Recruiter::class)
        ]);

        $response = $this->get('api/v1/jobs/9999999', ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertNotFound();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_create_a_job()
    {
        $recruiter = factory(Recruiter::class)->create();

        $job = factory(Job::class)->make([
            'recruiter_id'=> $recruiter->id
        ]);

        $response = $this->post('api/v1/jobs', [
            'title' => $job->title,
            'description' => $job->description,
            'status' => $job->status,
            'address' => $job->address,
            'salary' => $job->salary,
            'company' => $job->company,
            'recruiter_id' => $recruiter->id
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertCreated()
            ->assertJson([
                'title' => $job->title,
                'description' => $job->description,
                'status' => $job->status,
                'address' => $job->address,
                'salary' => $job->salary,
                'company' => $job->company,
                'recruiter_id' => $recruiter->id
            ])
            ->assertJsonStructure([
                'id', 'title', 'description', 'status', 'address', 'salary', 'company', 'recruiter_id', 'created_at',
                'updated_at'
            ]);

        $this->assertDatabaseCount('jobs', 1);

        $this->assertDatabaseHas('jobs', [
            'title' => $job->title,
            'description' => $job->description,
            'status' => $job->status,
            'address' => $job->address,
            'salary' => $job->salary,
            'company' => $job->company,
            'recruiter_id' => $recruiter->id
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_create_a_job_without_required_title()
    {
        $response = $this->post('api/v1/jobs', [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->post('api/v1/jobs', [
            'title'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        // make sure there are no job
        $this->assertDatabaseCount('jobs', 0);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_create_a_job_without_required_description()
    {
        $response = $this->post('api/v1/jobs', [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->post('api/v1/jobs', [
            'description'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        // make sure there are no job
        $this->assertDatabaseCount('jobs', 0);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_create_a_job_without_required_status()
    {
        $response = $this->post('api/v1/jobs', [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->post('api/v1/jobs', [
            'status'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        // make sure there are no job
        $this->assertDatabaseCount('jobs', 0);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_create_a_job_without_required_address()
    {
        $response = $this->post('api/v1/jobs', [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->post('api/v1/jobs', [
            'address'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        // make sure there are no job
        $this->assertDatabaseCount('jobs', 0);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_create_a_job_without_required_salary()
    {
        $response = $this->post('api/v1/jobs', [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->post('api/v1/jobs', [
            'salary'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        // make sure there are no job
        $this->assertDatabaseCount('jobs', 0);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_create_a_job_without_required_company()
    {
        $response = $this->post('api/v1/jobs', [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->post('api/v1/jobs', [
            'company'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        // make sure there are no job
        $this->assertDatabaseCount('jobs', 0);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_create_a_job_without_required_recruiter()
    {
        $response = $this->post('api/v1/jobs', [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->post('api/v1/jobs', [
            'recruiter_id'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        // make sure there are no job
        $this->assertDatabaseCount('jobs', 0);
    }



    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_update_a_job()
    {
        $recruiter = factory(Recruiter::class)->create([
            'user_id' => $this->user->id
        ]);

        $job = factory(Job::class)->create([
            'recruiter_id' => $recruiter->id
        ]);

        $response = $this->put('api/v1/jobs/' . $job->id, [
            'title' => 'Vaga para desenvolvedor',
            'description' => 'Descrição da vaga',
            'status' => 'open',
            'address' => 'endereço',
            'salary' => 4356.34,
            'company' => 'Empresa ABC 123',
            'recruiter_id' => 1,
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJson([
                'id' => $job->id,
                'title' => 'Vaga para desenvolvedor',
                'description' => 'Descrição da vaga',
                'status' => 'open',
                'address' => 'endereço',
                'salary' => 4356.34,
                'company' => 'Empresa ABC 123',
                'recruiter_id' => 1
            ])
            ->assertJsonStructure([
                'id', 'title', 'description', 'status', 'address', 'salary', 'company', 'recruiter_id', 'created_at',
                'updated_at'
            ]);

        $this->assertDatabaseCount('jobs', 1);

        $this->assertDatabaseHas('jobs', [
            'id' => $job->id,
            'title' => 'Vaga para desenvolvedor',
            'description' => 'Descrição da vaga',
            'status' => 'open',
            'address' => 'endereço',
            'salary' => 4356.34,
            'company' => 'Empresa ABC 123',
            'recruiter_id' => 1
        ]);

    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_update_a_job_with_nonexistent_id()
    {
       $job = factory(Job::class)->create([
            'recruiter_id'=> factory(Recruiter::class)
        ]);
        $recruiter = factory(Recruiter::class)->create();

        $response = $this->put('api/v1/jobs/999999', [
            'title' => $job->name,
            'description' => $job->description,
            'status' => $job->status,
            'address' => $job->address,
            'salary' => $job->salary,
            'company' => $job->company,
            'recruiter_id' => $recruiter->id
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertNotFound();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_update_a_job_without_a_required_fields()
    {
       $job = factory(Job::class)->create([
            'recruiter_id'=> factory(Recruiter::class)
        ]);

        $response = $this->put('api/v1/jobs/' . $job->id, [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->put('api/v1/jobs/' . $job->id, [
            'title',
            'description',
            'status',
            'address',
            'salary',
            'company',
            'recruiter_id'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        // make sure there are no job
        $this->assertDatabaseCount('jobs', 1);
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_delete_a_job()
    {
       $job = factory(Job::class)->create([
            'recruiter_id'=> factory(Recruiter::class)
        ]);

        $response = $this->delete('api/v1/jobs/' . $job->id, [], ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJsonStructure([
                'id', 'title', 'description', 'status', 'address', 'salary', 'company', 'recruiter_id', 'created_at',
                'updated_at'
            ]);

        $this->assertDatabaseCount('jobs', 0);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_delete_a_job_with_nonexistent_id()
    {
        factory(Job::class)->create([
            'recruiter_id'=> factory(Recruiter::class)
        ]);

        $response = $this->delete('api/v1/jobs/999999', [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertNotFound();

        $this->assertDatabaseCount('jobs', 1);
    }
}
