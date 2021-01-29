<?php

namespace Tests\Feature;

use Mockery as m;
use Tests\TestCase;
use App\Models\User;
use App\Repositories\JobRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobTest extends TestCase
{
    /** @test */
    public function it_access_job_index_method_test()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user, 'api')->json('GET', '/api/jobs');

        $response->assertStatus(200);

        $this->assertTrue(true);
        $this->assertInstanceOf(User::class, $user);
    }

    /** @test */
    public function it_should_find_a_user_test()
    {
        $repoMock = m::mock(JobRepository::class);

        $repoMock
            ->shouldReceive('findAll');

        $repoMock->findAll();

        $this->assertInstanceOf(JobRepository::class, $repoMock);
    }
}
