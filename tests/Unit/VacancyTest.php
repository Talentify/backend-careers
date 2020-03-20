<?php

namespace Tests\Unit;

use App\Models\Vacancy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VacancyTest extends TestCase
{
    use RefreshDatabase;

    protected $route = "/api/vacancies";
    protected $msg = ["success" => true];

    /**
     * Verifica se os dados estão sendo retornados
     *
     * @test
     */
    public function testListAll()
    {
        $response = $this->json('GET', $this->route);
        $response->assertStatus(200)->assertJson($this->msg);
    }

    /**
     * Verifica o retorna apenas um registro
     *
     * @test
     */
    public function testGetOne()
    {
        $data = factory(Vacancy::class)->create();
        $response = $this->json('GET', "$this->route/$data->id");
        $response->assertStatus(200)->assertJson($this->msg);
    }

    /**
     * Verifica o create
     *
     * @test
     */
    public function testCreate()
    {
        $data = factory(Vacancy::class)->create();
        $response = $this->json('POST', $this->route, $data->toArray());
        $response->assertStatus(200)->assertJson($this->msg);
    }

    /**
     * Verifica o update
     *
     * @test
     */
    public function testUpdate()
    {
        $data = factory(Vacancy::class)->create();
        $update = factory(Vacancy::class)->create();
        $response = $this->json('PUT', "$this->route/$data->id", $update->toArray());
        $response->assertStatus(200)->assertJson($this->msg);
    }

    /**
     * Verifica o delete
     *
     * @test
     */
    public function testDelete()
    {
        $data = factory(Vacancy::class)->create();
        $response = $this->json('DELETE', "$this->route/$data->id");
        $response->assertStatus(200)->assertJson($this->msg);
    }
}
