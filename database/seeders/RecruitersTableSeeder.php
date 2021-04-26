<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
        $companyA = Company::where('name', 'Company A')->firstOr();

        DB::table('recruiters')->insert([
            'id' => Str::uuid(),
            'name' => 'Recruiter One',
            'company_id' => $companyA->id,
            'login' => 'recruiter.one',
            'password' => Hash::make('123456')
        ]);

        $companyB = Company::where('name', 'Company B')->firstOr();

        DB::table('recruiters')->insert([
            'id' => Str::uuid(),
            'name' => 'Recruiter Two',
            'company_id' => $companyB->id,
            'login' => 'recruiter.two',
            'password' => Hash::make('123456'),
        ]);

        $companyC = Company::where('name', 'Company C')->firstOr();

        DB::table('recruiters')->insert([
            'id' => Str::uuid(),
            'name' => 'Recruiter Three',
            'company_id' => $companyC->id,
            'login' => 'recruiter.three',
            'password' => Hash::make('123456')
        ]);
    }
}
