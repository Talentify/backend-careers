<?php

namespace Tests\Feature;

use App\Models\Company;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    /** @test */
    public function check_if_company_register_is_correct()
    {
        $data = [
            'name' => 'Auto Test Case',
        ];
        $response = $this->post(route('apicompanies.store'), $data);
        $response->assertStatus(200);
    }

    /** @test */
    public function list_all_companies(){
        $response   = $this->get(route('apicompanies.index'));
        $response->assertStatus(200);
    }

    /** @test */
    public function show_just_one_company(){
        $company = Company::orderBy('id', 'DESC')->first();
        $response   = $this->get(route('apicompanies.index')."/".$company->id);
        $response->assertStatus(200);
        $this->assertEquals($company->id, $response['id']);
    }
}
