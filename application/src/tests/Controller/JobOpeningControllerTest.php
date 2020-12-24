<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JobOpeningControllerTest extends WebTestCase
{
    public function testShowJobs()
    {
        $client = static::createClient();

        $client->request('GET', '/jobs');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}