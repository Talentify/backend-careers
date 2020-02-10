<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRootPage() {
        $response = $this->get('/');

        $response->assertNoContent($status = 204);
    }

    public function testPageNotFound() {

        $url = $this->faker->word;

        while (in_array($url, ['jobs', 'job', 'users', 'user', 'token'])) {
            $url = $this->faker->word;
        }

        $response = $this->json('GET', '/' . $url);

        $response->assertStatus(404);
    }
}
