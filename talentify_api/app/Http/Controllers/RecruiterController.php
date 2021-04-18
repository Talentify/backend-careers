<?php

namespace App\Http\Controllers;

use App\Models\Recruiter;
use Illuminate\Http\Request;

class RecruiterController extends Controller
{
    public function register()
    {
        return Recruiter::create([
            'id_company' => request('id_company'),
            'name' => request('name'),
            'login ' => request('login '),
            'password' => request('password'),
        ]);
    } 
    
    public function login()
    {
        
    }
}
