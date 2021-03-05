<?php

namespace App\Services\Recruiter;


use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RecruiterRegisterService
{
    public function register(array $params = []): User | array
    {
        $validator = Validator::make($params, [
            'name' => 'required|string',
            'company' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()) {
            return [
                'error' => $validator->errors(),
            ];
        }

        $company = Company::firstOrCreate([
            'name' => $params['company']
        ]);
        $recruiter = User::create(array_merge(
                $params,
                [
                    'company_id' => $company->id,
                    'password' => Hash::make($params['password'])
                ]
            )
        );
        $recruiter->load('company');

        return $recruiter;
    }

    public function login($email, $password): array
    {
        $user = User::whereEmail($email)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            return [
                'error' => 'E-mail ou senha incorreto'
            ];
        }

        return [
            'token' => $user->createToken('default')->plainTextToken
        ];

    }
}
