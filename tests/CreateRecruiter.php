<?php


namespace Tests;


use App\Models\Recruiter;
use Illuminate\Support\Facades\Hash;

class CreateRecruiter
{
    public static function create(): Recruiter
    {
        $company = CreateCompany::create();

        $recruiter = Recruiter::create([
            'name' => 'Recruiter test',
            'company_id' => $company->id,
            'login' => 'test.alpha',
            'password' => Hash::make('123456')
        ]);

        return $recruiter;
    }
}