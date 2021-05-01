<?php

namespace App\Companies\Test;

use Tests\TestCase;
use Faker\Factory as Faker;

class TestCompaniesTest extends TestCase
{
    
    /**
     * Set up the test
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Faker::create();
    }

    /**
     * testCadastro
     *
     * @return void
     */
    public function testCadastro()
    {
        $this->post("/api/companies", ["name" => $this->faker->userName])
            ->assertStatus(200);
    }
    
    /**
     * testFaltaDeDadosTest
     *
     * @return void
     */
    public function testFaltaDeDados()
    {
        $this->post("/api/companies", ["name" => null])
            ->assertStatus(401);
    }
    
    /**
     * testListar
     *
     * @return void
     */
    public function testListar()
    {
        $this->get("/api/companies")
            ->assertStatus(200);
    }
}
