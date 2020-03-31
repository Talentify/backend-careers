<?php

namespace Tests\Feature;

use App\Opportunities;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Tests\Unit\Opportunity;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OpportunityTest extends TestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;

    public function test_can_create_opportunity() {
        $user = factory(User::class)->state('admin')->make();

        $this->be($user);

        $data = [
            'title'       => $this->faker->jobTitle(),
            'description' => $this->faker->text(),
            'status'      => 'active'
        ];

        $this->post(route('admin.opportunity.tests.store'), $data)
            ->assertStatus(200);
    }

    public function test_can_update_opportunity() {
        $this->seed(\OpportunitiesTableSeeder::class);

        $user = factory(User::class)->state('admin')->make();
        $opportunity = factory(Opportunities::class)->make();

        $this->be($user);

        $data = [
            'id'          => $opportunity->id,
            'title'       => $this->faker->jobTitle(),
            'description' => $this->faker->text(),
            'status'      => 'active'
        ];

        $this->put(route('admin.opportunity.tests.update', $opportunity->id), $data)
            ->assertStatus(200);
    }

    public function test_can_delete_opportunity() {
        $this->seed(\OpportunitiesTableSeeder::class);

        $user = factory(User::class)->state('admin')->make();
        $opportunity = factory(Opportunities::class)->make();

        $this->be($user);

        $this->delete(route('admin.opportunity.tests.delete', $opportunity->id))
            ->assertStatus(200);
    }
    public function test_can_list_opportunities() {
        $this->seed(\OpportunitiesTableSeeder::class);

        $user = factory(User::class)->state('admin')->make();

        $this->be($user);

        $this->get(route('admin.opportunity.tests.listOpportunities'))
            ->assertStatus(200);
    }
}
