<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    
    public function companies()
    {   
        return Company::all();
    }

    public function create()
    {   
        return Company::create([
            'name' => request('name')
        ]);
    }
}
