<?php

namespace Tests\Feature;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\DatabaseTestCase;

class RegisterTest extends DatabaseTestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegisterNewVacancy()
    {
        $user = $this->signIn();


        $response = $this->json('POST', route('v1.vacancies.create'),[
            "title" =>  $title = "Desenvolvedor JAVA ",
            "status" =>  $status = "Em Aberto",
            "address" =>  $address = "Rua Um A, 600 - Rio Santo/SP",
            "salary" =>  $salary = 5000,
            "keyword" =>  $keyword = "JAVA, Desenvolvedor"
        ]);

        $response->assertStatus(201)->assertJsonStructure([
            "title",
            "status",
            "address",
            "salary",
            "keyword"
        ])->assertJson([
            "title" =>  $title,
            "status" =>  $status,
            "address" =>  $address,
            "salary" =>  $salary,
            "keyword" =>  $keyword
        ]);
    }
}
