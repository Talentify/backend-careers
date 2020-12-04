<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class JobsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Home Screen.
     *
     * @return void
     */
    public function testJobsScreen()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get('/jobs/add')
            ->assertStatus(200);
    }

    /**
     * Test Search Screen.
     *
     * @return void
     */
    public function testJobsAdd()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->post('/jobs/add', [
                'title' => 'Developer',
                'description' => 'Developer',
                'workplace' => 'São Paulo',
                'salary' => 15000
            ])
            ->assertRedirect('dashboard');
    }

    /**
     * Test Search Screen.
     *
     * @return void
     */
    public function testJobsSalaryInvalid()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->post('/jobs/add', [
                'title' => 'Developer',
                'description' => 'Developer',
                'workplace' => 'São Paulo',
                'salary' => 'aaaa'
            ])
            ->assertRedirect('');
    }

    /**
     * Test Search Screen.
     *
     * @return void
     */
    public function testJobsTitleNull()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->post('/jobs/add', [
                'title' => '',
                'description' => 'Developer',
                'workplace' => 'São Paulo',
                'salary' => 15000
            ])
            ->assertRedirect('');
    }

    /**
     * Test Search Screen.
     *
     * @return void
     */
    public function testJobsTitleMaxString()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->post('/jobs/add', [
                'title' => Str::random(256),
                'description' => 'Developer',
                'workplace' => 'São Paulo',
                'salary' => 15000
            ])
            ->assertRedirect('');
    }

    /**
     * Test Search Screen.
     *
     * @return void
     */
    public function testJobsDescriptionNull()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->post('/jobs/add', [
                'title' => 'Developer',
                'description' => '',
                'workplace' => 'São Paulo',
                'salary' => 15000
            ])
            ->assertRedirect('');
    }

    /**
     * Test Search Screen.
     *
     * @return void
     */
    public function testJobsDescriptionMax()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->post('/jobs/add', [
                'title' => 'Developer',
                'description' => Str::random(10001),
                'workplace' => '',
                'salary' => 15000
            ])
            ->assertRedirect('');
    }

    /**
     * Test Search Screen.
     *
     * @return void
     */
    public function testJobsWorkplaceMax()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->post('/jobs/add', [
                'title' => 'Developer',
                'description' => 'Description',
                'workplace' => Str::random(256),
                'salary' => 15000
            ])
            ->assertRedirect('');
    }


    /**
     * Test Search Screen.
     *
     * @return void
     */
    public function testJobsWorkplaceNull()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->post('/jobs/add', [
                'title' => 'Developer',
                'description' => 'Description',
                'workplace' => '',
                'salary' => 15000
            ])
            ->assertRedirect('dashboard');
    }

    /**
     * Test Search Screen.
     *
     * @return void
     */
    public function testJobsSalaryNull()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->post('/jobs/add', [
                'title' => 'Developer',
                'description' => 'Description',
                'workplace' => '',
                'salary' => ''
            ])
            ->assertRedirect('dashboard');
    }
}
