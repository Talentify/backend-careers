<?php


namespace App\Models\Recruiter;


use App\Http\Services\JwtService;
use App\Models\Job;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CheckRecruiter
{
    public static function check(string $token, string $jobId): bool
    {
        try {
            $decodedToken = JwtService::decodeToken($token);

            Job::where('recruiter_id', $decodedToken->id)
                ->where('id', $jobId)
                ->firstOrFail();

            return true;
        } catch (ModelNotFoundException $e) {
            throw new \Exception($e->getMessage());
        }

    }

}