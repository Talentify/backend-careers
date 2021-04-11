<?php

namespace Tests\Feature;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\DatabaseTestCase;

class VacanciesTest extends DatabaseTestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegisterRecruter()
    {
        $response = $this->json('POST', route('api.register'),[
            "name" => $name = "Christisan",
            "email" => $email = "chkilian89@gmail.com",
            "username" => $username = "christian",
            "password" => "123456",
            "company" => [
                "name" => $company = "Vargas LTDA"
            ]
        ]);

        $response->assertStatus(201)->assertJsonStructure([
            'token',
            'user' => [
                'id',
                'name',
                'email',
                'username',
                'email_verified_at',
                'company_id',
                'created_at',
                'updated_at',
            ]
        ])->assertJson([
            'user' => [
                'name' => $name,
                "email" => $email,
                "username" => $username,
                "company_id" => Company::where('name', $company)->first()->id
            ]
        ]);
    }
}
