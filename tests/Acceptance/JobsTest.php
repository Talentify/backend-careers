<?php

namespace Test\Acceptance;

use Illuminate\Http\Response;
use Test\TestCase;

class JobsTest extends TestCase
{
    /**
     * Test Create Job
     * @covers \App\Http\Controllers\JobsController::create
     */
    public function testCreate()
    {
        $admin = factory('App\Models\Admin')->create();
        $this->be($admin, 'admin');
        $body = factory('App\Models\Job')->make()->toArray();
        $this->json(
            'POST',
            "/v1/jobs",
            $body
        )->seeStatusCode(Response::HTTP_CREATED);

        unset($body['workplace']);

        $this->seeInDatabase(
            'jobs',
            $body
        );
    }

    /**
     * Test Update Job
     * @covers \App\Http\Controllers\JobsController::update
     */
    public function testUpdate()
    {
        $admin = factory('App\Models\Admin')->create();
        $this->be($admin, 'admin');
        $job = factory('App\Models\Job')->create();
        $body = factory('App\Models\Job')->make()->toArray();
        $this->json(
            'PATCH',
            '/v1/jobs/' . $job->id,
            $body
        )->seeStatusCode(Response::HTTP_OK);

        unset($body['workplace']);

        $this->seeInDatabase(
            'jobs',
            $body
        );
    }

    /**
     * Test Get Job
     * @covers \App\Http\Controllers\JobsController::get
     */
    public function testGet()
    {
        $job = factory('App\Models\Job')->create();
        $this->json(
            'GET',
            '/v1/jobs/' . $job->id
        )->seeStatusCode(Response::HTTP_OK)
            ->seeJson($job->toArray());
    }


    /**
     * Test Get All Jobs
     * @covers \App\Http\Controllers\JobsController::getAll
     */
    public function testGetAll()
    {
        $job = factory('App\Models\Job')->create();
        $this->json(
            'GET',
            '/v1/jobs'
        )->seeStatusCode(Response::HTTP_OK);

        $response = json_decode($this->response->getContent(), true);
        $this->assertEquals($response['data'][0], $job->toArray());
    }

    /**
     * Test Create Get All Paginate
     * @covers \App\Http\Controllers\JobsController::getAll
     */
    public function testGetAllPaginate()
    {
        factory('App\Models\Job')->times(30)->create();
        $this->json(
            'GET',
            '/v1/jobs',
            [
            ],
            [
                'perpage' => 5,
                'page' => 2
            ]
        )->seeStatusCode(Response::HTTP_OK);

        $response = json_decode($this->response->getContent(), true);
        $this->assertCount(5, $response['data']);
        $this->assertEquals(2, $response['current_page']);
        $this->assertEquals(6, $response['from']);
        $this->assertEquals(6, $response['last_page']);
        $this->assertEquals(10, $response['to']);
        $this->assertEquals(30, $response['total']);
    }

    /**
     * Test Delete Job
     * @covers \App\Http\Controllers\JobsController::delete
     */
    public function testDelete()
    {
        $admin = factory('App\Models\Admin')->create();
        $this->be($admin, 'admin');
        $job = factory('App\Models\Job')->create();
        $this->json(
            'DELETE',
            '/v1/jobs/' . $job->id
        )->seeStatusCode(Response::HTTP_NO_CONTENT)
            ->notSeeInDatabase(
                'jobs',
                ['id' => $job->id, 'deleted_at' => null]
            );
    }

    /**
     * Test Apply a Job
     * @covers \App\Http\Controllers\JobsController::apply
     */
    public function testApply()
    {
        $user = factory('App\Models\User')->create();
        $this->be($user, 'user');
        $job = factory('App\Models\Job')->create();
        $this->json(
            'POST',
            "/v1/jobs/{$job->id}/apply"
        )->seeStatusCode(Response::HTTP_OK)
            ->seeInDatabase(
                'jobs_applies',
                ['job_id' => $job->id, 'user_id' => $user->id]
            );
    }
}
