<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class RecruiterTest extends TestCase
{
    /** @test */
    public function check_if_recruiter_register_is_correct()
    {
        $data = [
            'name'          => 'Auto Test Case',
            'email'         => 'test@admin.com',
            'passworld'     => bcrypt('12345678'),
            'id_company'    => null,
        ];
        $response = $this->post(route('apirecruiters.store'), $data);
        $response->assertStatus(200);
    }

    /** @test */
    public function list_all_recuiters(){
        $response   = $this->get(route('apirecruiters.index'));
        $response->assertStatus(200);
    }

    /** @test */
    public function show_just_one_recruiter(){
        $company = User::orderBy('id', 'DESC')->first();
        $response   = $this->get(route('apirecruiters.index')."/".$company->id);
        $response->assertStatus(200);
        $this->assertEquals($company->id, $response['id']);
    }
}
