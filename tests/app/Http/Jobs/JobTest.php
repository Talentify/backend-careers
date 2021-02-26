<?php

use App\Models\Enums\StatusEnum;
use Illuminate\Support\Facades\DB;

class JobTest extends TestCase
{

    public function testShouldReturnAllJobs()
    {
        $this->get('/jobs');

        $this->response
            ->assertStatus(200)
            ->assertJsonStructure([
                "current_page",
                "data",
            ]);
    }

    public function testShouldUnauthorized()
    {
        $this->put('/manage/jobs/-1',[]);
        $this->response->assertUnauthorized();
    }

    public function testShouldCreateGetUpdateDeleteJob()
    {
        $this->post('/auth',[
            'email'    => 'admin@system.local',
            'password' => 'password',
        ]);

        $token = json_decode($this->response->getContent())->access_token;

        DB::beginTransaction();

        # CREATE
        $this->post('/manage/jobs',[
            'title'         => 'Job Test',
            'description'   => 'teste de integração para verificar a inserção na database',
            'status'        => StatusEnum::OPEN(),
            'workplace'     => 'Fully Remote! 4ever!',
            'salary'         => 9999.99,
        ], ['Authorization' => "Bearer {$token}"]);

        $this->response->assertStatus(201);
        $this->response->assertJsonStructure(["id"]);

        // get generate id
        $id = json_decode($this->response->getContent())->id;

        # GET
        $this->get('jobs/' . $id);
        $this->response->assertStatus(200);
        $this->response->assertJsonPath('status', StatusEnum::OPEN()->value);

        # UPDATE
        $this->put('/manage/jobs/' . $id,[
            'title'         => 'change title!',
            'description'   => 'teste de integração para verificar a inserção na database',
            'status'        => StatusEnum::OPEN(),
            'workplace'     => 'Fully Remote! 4ever!',
            'salary'         => 9999.99,
        ], ['Authorization' => "Bearer {$token}"]);

        $this->response->assertStatus(200);
        $this->response->assertJsonPath('title', 'change title!');

        # DELETE
        $this->delete('/manage/jobs/' . $id, [], ['Authorization' => "Bearer {$token}"]);
        $this->response->assertStatus(200);

        DB::rollback();
    }
}
