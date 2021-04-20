<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $faker = \Faker\Factory::create();
        
        for ($i = 0; $i < 6; $i++) {
            Company::create([
                'name' => $faker->company
            ]);
        }

    }
}
