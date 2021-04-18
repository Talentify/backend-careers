<?php

namespace Database\Seeders;

use App\Models\Recruiter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RecruitersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $password = Hash::make('talentify123');

        Recruiter::create([
            'id_company' => 1,
            'name' => 'Administrator',
            'login' => 'admin',
            'password' => $password,
        ]);

        $recruitersNames = ["Eider", "Carlos", "Adam"];
        $recruitersLogin = ["eider", "carlos", "adam"];
        $recruitersPass = ["talentify1", "talentify2", "talentify3"];

        for ($i = 0; $i < count($recruitersNames); $i++) {
            Recruiter::create([
                'id_company' => $i+1,
                'name' => $recruitersNames[$i],
                'login' => $recruitersLogin[$i],
                'password' => Hash::make($recruitersPass[$i]),
            ]);
        }
    }
}
