<?php


namespace Tests;


use App\Models\Company;

class CreateCompany
{
    public static function create(): Company
    {
        $company = Company::create([
            'name' => 'Company Test'
        ]);

        return $company;
    }
}