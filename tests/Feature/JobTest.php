<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\ApplicationSetup;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;

class JobTest extends ApplicationSetup
{

    private $defaultJobStructure = [
        "title",
        "description",
        "status",
        "workplace",
        "salary",
        "created_at",
        "deleted_at",
        "updated_at",
    ];
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testListJobSuccessWithPagination()
    {
        $response = $this->json('GET', '/jobs', ['page' => 1, 'paginate' => 10]);

        $response->assertStatus(200);

        $jobStructureWithPagination = $this->paginationStructure;
        $jobStructureWithPagination['data'] = [
            '*' => $this->defaultJobStructure
        ];

        $response->assertJsonStructure($jobStructureWithPagination);
    }

    public function testListJobSuccessWithoutPagination()
    {
        $response = $this->json('GET', '/jobs');

        $response->assertStatus(200);        

        $response->assertJsonStructure(['*' => $this->defaultJobStructure]);
    }

    public function testGetOneJobSuccess()
    {

        $data = factory(\App\Models\Job::class)->create();
        $response = $this->json('GET', '/job/' . $data->id);
        $response->assertStatus(200);
        // $response->assertJsonFragment($data->toArray());
        $response->assertJsonStructure($this->defaultJobStructure);
        $this->assertDatabaseHas('jobs', $data->toArray());

    }

    public function testGetOneJobError()
    {
        $response = $this->json('GET', '/job/' . rand());
        $response->assertStatus(404);
    }

    public function testCreateJobSuccess()
    {
        $data = factory(\App\Models\Job::class)->make();

        $user = User::find(1);
        Passport::actingAs($user);

        $response = $this->json('POST', '/job', $data->toArray());

        $response->assertStatus(201);
        $this->assertDatabaseHas('jobs', $data->toArray());
    }

    public function testCreateJobErrorWithoutTitle()
    {
        $data = factory(\App\Models\Job::class)->make();

        $user = User::find(1);
        Passport::actingAs($user);

        unset($data->title);

        $response = $this->json('POST', '/job', $data->toArray());

        $response->assertStatus(422);
        $this->assertDatabaseMissing('jobs', $data->toArray());
    }

    public function testCreateJobErrorWithoutDescription()
    {
        $data = factory(\App\Models\Job::class)->make();

        $user = User::find(1);
        Passport::actingAs($user);

        unset($data->description);

        $response = $this->json('POST', '/job', $data->toArray());

        $response->assertStatus(422);
        $this->assertDatabaseMissing('jobs', $data->toArray());
    }

    public function testCreateJobErrorWithoutStatus()
    {
        $data = factory(\App\Models\Job::class)->make();

        $user = User::find(1);
        Passport::actingAs($user);

        unset($data->status);

        $response = $this->json('POST', '/job', $data->toArray());

        $response->assertStatus(422);
        $this->assertDatabaseMissing('jobs', $data->toArray());
    }

    public function testCreateJobErrorUserWithoutPermission()
    {
        $data = factory(\App\Models\Job::class)->make();

        $user = $this->generateUser();

        // var_dump($user);
        Passport::actingAs($user);

        $response = $this->json('POST', '/job', $data->toArray());

        $response->assertForbidden();
        $this->assertDatabaseMissing('jobs', $data->toArray());
    }

    public function testUpdateJobSuccess()
    {
        $data = factory(\App\Models\Job::class)->create();

        $user = User::find(1);
        Passport::actingAs($user);

        $newData = factory(\App\Models\Job::class)->make();

        $response = $this->json('PUT', '/job/' . $data->id, $newData->toArray());

        $response->assertStatus(200);
        $this->assertDatabaseHas('jobs', $newData->toArray());
    }

    public function testUpdateJobErrorWithoutTitle()
    {
        $data = factory(\App\Models\Job::class)->create();

        $user = User::find(1);
        Passport::actingAs($user);

        $newData = factory(\App\Models\Job::class)->make();

        unset($newData->title);

        $response = $this->json('PUT', '/job/' . $data->id, $newData->toArray());

        $response->assertStatus(422);
    }

    public function testUpdateJobErrorWithoutDescription()
    {
        $data = factory(\App\Models\Job::class)->create();

        $user = User::find(1);
        Passport::actingAs($user);

        $newData = factory(\App\Models\Job::class)->make();

        unset($newData->description);

        $response = $this->json('PUT', '/job/' . $data->id, $newData->toArray());

        $response->assertStatus(422);
    }

    public function testUpdateJobErrorWithoutStatus()
    {
        $data = factory(\App\Models\Job::class)->create();

        $user = User::find(1);
        Passport::actingAs($user);

        $newData = factory(\App\Models\Job::class)->make();

        unset($newData->status);

        $response = $this->json('PUT', '/job/' . $data->id, $newData->toArray());

        $response->assertStatus(422);
    }

    public function testUpdateJobErrorUserWithoutPermission()
    {
        $data = factory(\App\Models\Job::class)->create();

        $user = $this->generateUser();

        // var_dump($user);
        Passport::actingAs($user);

        $newData = factory(\App\Models\Job::class)->make();

        $response = $this->json('PUT', '/job/' . $data->id, $newData->toArray());

        $response->assertForbidden();
    }

    

    public function testDeleteJobSuccess()
    {
        $data = factory(\App\Models\Job::class)->create();

        $user = User::find(1);
        Passport::actingAs($user);

        $response = $this->json('DELETE', '/job/' . $data->id);

        $response->assertStatus(200);
    }

    public function testDeleteJobErrorUserWithoutPermission()
    {
        $data = factory(\App\Models\Job::class)->create();

        $user = $this->generateUser();
        Passport::actingAs($user);

        $response = $this->json('DELETE', '/job/' . $data->id);

        $response->assertForbidden();
    }
}
