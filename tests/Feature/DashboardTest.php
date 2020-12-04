<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Home Screen.
     *
     * @return void
     */
    public function testDashboardScreen()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get('/dashboard')
            ->assertStatus(200);
    }

    /**
     * Test Search Screen.
     *
     * @return void
     */
    public function testDashboardPagination()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get('/dashboard/' . 1)
            ->assertStatus(200);
    }

    /**
     * Test Search Screen.
     *
     * @return void
     */
    public function testInvalidDashboardScreen()
    {
        $response = $this->get('/search/string');
        $response->assertStatus(500);
    }
}
