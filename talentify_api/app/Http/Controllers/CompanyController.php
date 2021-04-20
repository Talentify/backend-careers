<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    
    public function getall()
    {   
        $companies = Company::all();

        $response = [
            'status' => true,
            'message' => 'Companies obtained!',
            'data' => $companies
        ];
        
        return response($response);
    }
    
    public function store(Request $request)
    {   
        $company = Company::create([
            'name' => $request->name
        ]);
        
        $response = [
            'status' => true,
            'message' => 'Company Created!',
            'data' => $company
        ];

        return response($response, 201);
    }

    public function show(Company $company)
    {   
        $response = [
            'status' => true,
            'data' => $company
        ];

        return response($response, 400);
    }
}
