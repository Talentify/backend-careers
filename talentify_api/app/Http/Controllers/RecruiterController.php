<?php

namespace App\Http\Controllers;

use App\Models\Recruiter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class RecruiterController extends Controller
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

        $token = $recruiter->createToken('myapitoken')->plainTextToken;

        $response = [
            'user' => $recruiter,
            'token' => $token
        ];

        return response($response, 201);
    } 
    
    public function login(Request $request)
    {   
        $fields = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string'
        ]);
        
        $recruiter = Recruiter::where('login', $fields['login'])->first();

        if(!$recruiter || !Hash::check($fields['password'], $recruiter->password)){
            return response([
                'message' => 'Credenciais incorretas!'
            ], 401);
        }
        
        $token = $recruiter->createToken('myapitoken')->plainTextToken;

        $response = [
            'user' => $recruiter,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout()
    {   
        $recruiter = auth()->user();

        auth()->user()->tokens()->delete();
        return [
            'message' => 'Usuário: '.$recruiter->login.' Deslogado!'
        ];
    }
}
