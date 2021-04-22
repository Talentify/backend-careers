<?php

namespace Tests\Unit;

use App\Models\Company;
use PHPUnit\Framework\TestCase;

class CompanyTest extends TestCase
{
    private $company;

    protected function setUp(): void
    {
        parent::setUp();
        $this->company = new Company();
    }

    public function testFillable()
    {
        $this->assertEquals(['name'],$this->company->getFillable());
    }

    public function testDates()
    {
        $dates = ['created_at', 'updated_at'];
        foreach ($dates as $date) {
            $this->assertContains($date, $this->company->getDates());
        }
        $this->assertCount(count($dates), $this->company->getDates());
    }
}
