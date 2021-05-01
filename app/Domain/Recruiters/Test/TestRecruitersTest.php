<?php

namespace App\Recruiters\Test;

use App\Domain\Companies\Model\Company;
use Tests\TestCase;
use Faker\Factory as Faker;

class TestRecruitersTest extends TestCase
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
        $company = (new Company())->first();

        $this->post("/api/recruiters", [
            "name" => $this->faker->userName,
            "email" => $this->faker->email,
            "password" => $this->faker->password,
            "company_id" => $company->id
        ])
            ->assertStatus(200);
    }
    
    /**
     * testFaltaDeDadosTest
     *
     * @return void
     */
    public function testFaltaDeDados()
    {
        $this->post("/api/recruiters", ["name" => null])
            ->assertStatus(401);
    }
    
    /**
     * testListar
     *
     * @return void
     */
    public function testListar()
    {
        $this->get("/api/recruiters")
            ->assertStatus(200);
    }
}
