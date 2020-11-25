<?php

namespace Tests\Feature\Jobs;

use Tests\TestCase;

class JobTest extends TestCase
{
    public function testCreateJob()
    {
        $response = $this->post('/api/jobs');
        $response->assertStatus(200);
    }
}
