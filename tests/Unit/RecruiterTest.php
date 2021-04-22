<?php

namespace Tests\Unit;

use App\Models\Recruiter;
use PHPUnit\Framework\TestCase;

class RecruiterTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->recruiter = new Recruiter();
    }

    public function testFillable()
    {
        $this->assertEquals(['name', 'email', 'password', 'company_id'],$this->recruiter->getFillable());
    }

    public function testCastsAttribute()
    {
        $casts = ['id' => 'int', 'email_verified_at' => 'datetime'];

        $this->assertEquals($casts, $this->recruiter->getCasts());
    }

    public function testDates()
    {
        $dates = ['created_at', 'updated_at'];
        foreach ($dates as $date) {
            $this->assertContains($date, $this->recruiter->getDates());
        }
        $this->assertCount(count($dates), $this->recruiter->getDates());
    }
}
