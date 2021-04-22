<?php

use Illuminate\Database\Seeder;
use  App\Models\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = Company::all()->count();
        if($company == 0) {
            Company::create(['name' => 'Talentify']);
        }
    }
}
