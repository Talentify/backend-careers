<?php

namespace App\Recruiters\Test;

use App\Domain\Recruiters\Model\Recruiter;
use App\Domain\Vacancies\Model\Vacancy;
use Tests\TestCase;
use Faker\Factory as Faker;

class TestVacanciesTest extends TestCase
{

    /**
     * Set up the test
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Faker::create();
        $this->recruiter = Recruiter::inRandomOrder()->first();
    }

    /**
     * testCadastro
     *
     * @return void
     */
    public function testCadastro()
    {
        $this->actingAs($this->recruiter, 'api')->post("/api/vacancies", [
            "title" => $this->faker->jobTitle,
            "descripton" => $this->faker->email,
            "address" => $this->faker->state,
            "salary" => $this->faker->randomNumber,
            "company" => $this->faker->company
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'descripton',
                    'status',
                    'address',
                    'salary',
                    'company',
                    'recruiter_id',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }
    
    /**
     * testFaltaDeDadosTest
     *
     * @return void
     */
    public function testFaltaDeDados()
    {
        $this->actingAs($this->recruiter, 'api')->post("/api/vacancies", ["name" => null])
            ->assertStatus(401)
            ->assertJsonStructure([
                'errors'
            ]);
    }
    
    /**
     * testListar
     *
     * @return void
     */
    public function testListar()
    {
        $this->actingAs($this->recruiter, 'api')->get("/api/vacancies")
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'descripton',
                        'status',
                        'address',
                        'salary',
                        'company',
                        'recruiter_id',
                        'created_at',
                        'updated_at'
                ]]
            ]);
    }
    
    /**
     * testUpdate_Same_Recruiter
     *
     * @return void
     */
    public function testUpdate_Same_Recruiter()
    {
        $vacancy = Vacancy::inRandomOrder()->first();
        $recruiter = Recruiter::where("id", $vacancy->recruiter_id)->first();
        $this->actingAs($recruiter, 'api')->put("/api/vacancies/".$vacancy->id, [
            "title" => $this->faker->jobTitle,
            "descripton" => $this->faker->email,
            "address" => $this->faker->state,
            "salary" => $this->faker->randomNumber,
            "company" => $this->faker->company
        ])
        ->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'descripton',
                'status',
                'address',
                'salary',
                'company',
                'recruiter_id',
                'created_at',
                'updated_at'
            ]
        ]);
    }
    
    /**
     * testUpdate_Another_Recruiter
     *
     * @return void
     */
    public function testUpdate_Another_Recruiter()
    {
        $vacancy = Vacancy::inRandomOrder()->whereNotIn('recruiter_id', [$this->recruiter->id])->first();
        $this->actingAs($this->recruiter, 'api')->put("/api/vacancies/".$vacancy->id, [
            "title" => $this->faker->jobTitle,
            "descripton" => $this->faker->email,
            "address" => $this->faker->state,
            "salary" => $this->faker->randomNumber,
            "company" => $this->faker->company
        ])
        ->assertStatus(401)
        ->assertJsonStructure([
            'errors'
        ]);
    }
    
    /**
     * testDeletar
     *
     * @return void
     */
    public function testDeletar()
    {
        $vacancy = Vacancy::inRandomOrder()->first();
        $recruiter = Recruiter::where("id", $vacancy->recruiter_id)->first();
        $this->actingAs($recruiter, 'api')->delete("/api/vacancies/".$vacancy->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'descripton',
                    'status',
                    'address',
                    'salary',
                    'company',
                    'recruiter_id',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }
    
    /**
     * testDeletar_Recruiter_Incorrect
     *
     * @return void
     */
    public function testDeletar_Recruiter_Incorrect()
    {
        $vacancy = Vacancy::inRandomOrder()->whereNotIn('recruiter_id', [$this->recruiter->id])->first();
        $this->actingAs($this->recruiter, 'api')->delete("/api/vacancies/".$vacancy->id)
            ->assertStatus(401)
            ->assertJsonStructure([
                'errors'
            ]);
    }
}
