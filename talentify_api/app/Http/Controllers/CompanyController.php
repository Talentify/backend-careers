<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiResponseController as ApiResponseController;

class CompanyController extends ApiResponseController
{
    
    public function getall()
    {   
        $companies = Company::all();            
        return $this->sendResponse($companies, 'Companies retrieved successfully!');
    }
    
    public function store(Request $request)
    {   
        $fields = $request->validate([
            'name' => 'required|string'
        ]);

        $company = Company::create([
            'name' => $fields['name']
        ]);
        
        return $this->sendResponse($company, 'Company created successfully!', 201);           
    }
    
    public function show(Company $company)
    {   
        return $this->sendResponse([$company], 'Company retrieved successfully!'); 
    }    

}
