<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'id' => Str::uuid(),
            'name' => 'Company A'
        ]);

        DB::table('companies')->insert([
            'id' => Str::uuid(),
            'name' => 'Company B'
        ]);

        DB::table('companies')->insert([
            'id' => Str::uuid(),
            'name' => 'Company C'
        ]);
    }
}
