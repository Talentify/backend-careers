<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Recruiter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class RecruitersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        $companyIds = $this->get_companies_ids();

        $recruitersNames = ["Admin", "Eider", "Carlos"];
        $recruitersLogin = ["admin", "eider", "carlos"];
        $recruitersPass = ["talentify1", "talentify2", "talentify3"];

        for ($i = 0; $i < count($recruitersNames); $i++) {
            Recruiter::create([
                'id_company' => $companyIds[array_rand($companyIds)],
                'name' => $recruitersNames[$i],
                'login' => $recruitersLogin[$i],
                'password' => Hash::make($recruitersPass[$i]),
            ]);
        }
    }   
    
    public function get_companies_ids()
    {   
        $companies = Company::select('id')->limit(6)->get();
        $companyIds = array();

        foreach ($companies as $company) {
            $companyIds[] = $company->id;
        }

        return $companyIds;
    }
}
