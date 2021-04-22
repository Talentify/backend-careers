<?php

namespace Tests\Unit;

use App\Models\Position;
use PHPUnit\Framework\TestCase;

class PositionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->position = new Position();
    }

    public function testFillable()
    {
        $this->assertEquals(['title', 'description', 'address', 'salary', 'status', 'company_id', 'recruiter_id'],$this->position->getFillable());
    }

    public function testCastsAttribute()
    {
        $casts = ['id' => 'int', 'status' => 'boolean'];

        $this->assertEquals($casts, $this->position->getCasts());
    }

    public function testDates()
    {
        $dates = ['created_at', 'updated_at'];
        foreach ($dates as $date) {
            $this->assertContains($date, $this->position->getDates());
        }
        $this->assertCount(count($dates), $this->position->getDates());
    }
}
