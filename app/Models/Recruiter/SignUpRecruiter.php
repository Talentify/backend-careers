<?php


namespace App\Models\Recruiter;


use App\Models\Recruiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignUpRecruiter
{
    public static function store(Request $request): Recruiter
    {
        return Recruiter::create([
            'name' => $request->name,
            'login' => $request->login,
            'password' => Hash::make($request->password),
            'company_id' => $request->company_id
        ]);
    }
}