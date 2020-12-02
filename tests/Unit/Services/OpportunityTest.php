<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\Opportunity;
use App\Services\OpportunityService;

class OpportunityTest extends TestCase
{
    public function testAllShouldReturnAllOpportunities()
    {
        Opportunity::factory()->count(10)->create();
        $count = Opportunity::count();

        $opportunities = app(OpportunityService::class)->all();

        $this->assertNotNull($opportunities);
        $this->assertInstanceOf(Opportunity::class, $opportunities->first());
        $this->assertCount($count, $opportunities);
    }

    public function testCreateShouldSuccessfullyReturnANewOpportunity()
    {
        $data = Opportunity::factory()->raw();

        $createOpportunity = app(OpportunityService::class)->create($data);

        $this->assertNotNull($createOpportunity);
        $this->assertEquals($data['title'], $createOpportunity->title);
    }
}
