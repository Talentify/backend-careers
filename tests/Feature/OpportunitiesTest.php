<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Opportunity;

class OpportunitiesTest extends TestCase
{
    public function testListAllOpportunities()
    {
        $opportunities = Opportunity::factory()->count(5)->create();
        $count = Opportunity::count();

        $response = $this->get('opportunities');

        $response
            ->assertStatus(200)
            ->assertJsonCount($count, 'data')
            ->assertJsonFragment([
                'title' => $opportunities->first()->title
            ]);
    }

    public function testCreateAnOpportunityShouldFailWhenNoUserAuthenticated()
    {
        $data = Opportunity::factory()->raw();

        $response = $this->postJson('opportunities', $data);

        $response->assertStatus(401);
    }

    public function testCreateAnOpportunityShouldSuccessWhenAuthenticated()
    {
        $user = User::factory()->create();
        $data = Opportunity::factory()->raw();

        $response = $this
            ->actingAs($user, 'api')
            ->postJson('opportunities', $data);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'title' => $data['title']
            ]);

        $this->assertDatabaseHas('opportunities', [
            'title'       => $data['title'],
            'description' => $data['description']
        ]);
    }
}
