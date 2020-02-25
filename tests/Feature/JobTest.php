<?php

namespace Tests\Feature;

use App\Models\Jobs;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class JobTest extends TestCase
{
    public function testAnyoneSeeActiveJobs()
    {
        $response = $this->get(route('base.jobs'));
        $response->assertSuccessful();
        $response->assertViewHas('jobs');
    }

    public function testAdminSeeAllJobs()
    {
        Session::start();

        $user = User::where('email', 'admin@admin.com')->first();

        $response = $this->actingAs($user)->get(
            route('admin.jobs.index')
        );

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);
    }

    public function testSimpleUserCannotSeeAllJobs()
    {
        Session::start();

        $user = User::where('email', 'user@user.com')->first();

        $response = $this->actingAs($user)->get(route('admin.jobs.index'));

        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }

    public function testCreateNewJob()
    {
        Session::start();

        $user = User::where('email', 'admin@admin.com')->first();

        $job = factory(Jobs::class)->make();
        $job = $job->toArray();
        $job['_token'] = Session::token();

        $response = $this->actingAs($user)->post(route('admin.jobs.store'), $job);

        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }

    public function testEditJob()
    {
        Session::start();

        $user = User::where('email', 'admin@admin.com')->first();

        $job = Jobs::find(rand(1, 100));
        $job = $job->toArray();
        $job['company'] = 'Alter Company By PhpUnit';
        $job['_token'] = Session::token();

        $response = $this->actingAs($user)->put(
            route('admin.jobs.update', ['uuid' => $job['uuid']]),
            $job
        );

        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }
}
