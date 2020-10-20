<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class JobsTest extends TestCase
{

    use WithoutMiddleware, DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShouldCreateaNewJob()
    {
        $result = $this->json('POST', '/api/jobs', [
            "job" => [
                "title"       => "PHP developer",
                "description" => "This is my description for PHP Developer",
                "workplace"   => "To mutch monster",
                "salary"      => "4500.78",
                "status"      => "opened"
            ]
        ]);

        $this->assertDatabaseHas('jobs', [
            "title"       => "PHP developer",
            "description" => "This is my description for PHP Developer",
            "workplace"   => "To mutch monster",
            "salary"      => "4500.78",
            "status"      => "opened"
        ]);
    }
}
