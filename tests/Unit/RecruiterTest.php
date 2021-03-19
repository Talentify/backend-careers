<?php

namespace Tests\Unit;
use Tests\TestCase;
use App\User;
use App\Models\Vacancy;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Response as FacadeResponse;

class RecruiterTest extends TestCase
{
    

    protected $faker;

    public function setUp(): void {
        parent::setUp();
        $this->faker = Factory::create();
    }
    
    public function test_WhenStoreANewRecruit_ShouldReturnStatus201_And_ShouldReturnEqualsName() {

        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '$2y$12$qXbS6myG8gytVtjhCdUa7uiQfnA7YtmSE3B8ZcdprbhzGF9eZRZgO',
            'company_name' => $this->faker->name
        ];

        $response = $this->post('/api/store-recruiter', $data);
        $response->assertStatus(201);

        $this->assertEquals($data['name'], $response['name']);

    }

     public function test_WhenGetAllVacancy_ShouldReturnStatus200() {

         $response = $this->get('/api/vacancy-all/');
         $response->assertStatus(200);

     }

}
