<?php

namespace App\Http\Controllers;

use App\Models\Recruiter;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiResponseController as ApiResponseController;

use Illuminate\Support\Facades\Hash;

class RecruiterController extends ApiResponseController
{
    public function register(Request $request)
    {           
        $fields = $request->validate([
            'id_company' => 'required',
            'name' => 'required|string',
            'login' => 'required|string|unique:recruiters',
            'password' => 'required|string'
        ]);
        
        $recruiter = Recruiter::create([
            'id_company' => $fields['id_company'],
            'name' => $fields['name'],
            'login' => $fields['login'],
            'password' => bcrypt($fields['password'])
        ]);
        
        $token = $recruiter->createToken('my_api_token')->plainTextToken;
        
        $recruiterData = [
            'user' => $recruiter,
            'token' => $token
        ];

        return $this->sendResponse($recruiterData, 'A new recruiter created successfully!', 201); 
    } 
    
    public function login(Request $request)
    {   
        $fields = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string'
        ]);
        
        $recruiter = Recruiter::where('login', $fields['login'])->first();
        
        if(!$recruiter || !Hash::check($fields['password'], $recruiter->password)){
            return $this->sendError('Incorrect credentials!');            
        }
        
        $token = $recruiter->createToken('myapitoken')->plainTextToken;

        $response = [
            'user' => $recruiter,
            'token' => $token
        ];
                
        return $this->sendResponse($response, 'Recruiter logged in successfully!'); 
    }

    public function logout()
    {           
        $recruiter = auth()->user();
        auth()->user()->tokens()->delete();
        return $this->sendResponse([],'User: '.$recruiter->login.' disconnected!'); 
    }
}
