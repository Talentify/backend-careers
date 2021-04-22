<?php


namespace Tests\Traits;


use Illuminate\Foundation\Testing\TestResponse;

trait TestAssertJsonGragment
{
    public function assertJsonFragmentTest(TestResponse $response)
    {
        $response->assertStatus(200);
        $response->assertJsonCount(3);
        $response->assertJsonFragment(['title' => 'Dev Laravel']);
        $response->assertJsonFragment(['description' => 'Desc Laravel']);
        $response->assertJsonFragment(['address' => 'Address Laravel']);
        $response->assertJsonFragment(['salary' => '17000']);
        $response->assertJsonFragment(['company_id' => 1]);
        $response->assertJsonFragment(['recruiter_id' => 1]);
    }
}
