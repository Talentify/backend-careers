<?php


namespace App\Services\Recruiter;


use App\Models\User;

class RecruiterService
{
    public function find($recruiterId)
    {
        return User::find($recruiterId);
    }
}
