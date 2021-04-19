<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    
    public function getall()
    {   
        // return Company::all();
        return auth()->user();
    }

    public function store()
    {   
        return Company::create([
            'name' => request('name')
        ]);
    }

    public function show(Company $company)
    {   
        return $company;
    }
}
