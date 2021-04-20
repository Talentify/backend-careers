<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanyController extends Controller
{

    public function getall()
    {   
        return Company::all();
    }
    
    public function store(Request $request)
    {   
        $company = Company::create([
            'name' => $request->name
        ]);
        
        return response()->json($company, 201);
    }

    public function show(Company $company)
    {   
        return $company;
    }
}
