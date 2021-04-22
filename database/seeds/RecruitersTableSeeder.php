<?php

use Illuminate\Database\Seeder;
use App\Models\Recruiter;

class RecruitersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recruiter = Recruiter::all()->count();
        if($recruiter == 0) {
            Recruiter::create(
                [
                    'name' => 'Recrutador',
                    "email" => "recrutador@email.com",
                    "password"=> bcrypt("secret"),
                    "company_id"=> 1
                ]);
        }
    }
}
