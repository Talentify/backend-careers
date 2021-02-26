<?php

class AuthTest extends TestCase
{

    public function testShouldAuthenticate()
    {
        $this->post('/auth',[
            'email'    => 'admin@system.local',
            'password' => 'password',
        ]);

        $this->response->assertStatus(200);
        $this->response->assertJsonStructure(["access_token"]);
    }

}
