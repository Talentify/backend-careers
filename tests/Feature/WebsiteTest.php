<?php

namespace Tests\Feature;

use Tests\TestCase;

class WebsiteTest extends TestCase
{
    /**
     * Test Home Screen.
     *
     * @return void
     */
    public function testHomeScreen()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test Search Screen.
     *
     * @return void
     */
    public function testSearchScreen()
    {
        $response = $this->get('/search/1');
        $response->assertStatus(200);
    }

    /**
     * Test Search Screen.
     *
     * @return void
     */
    public function testInvalidSearchScreen()
    {
        $response = $this->get('/search/string');
        $response->assertStatus(500);
    }
}
