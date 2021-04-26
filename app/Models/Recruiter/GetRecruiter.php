<?php


namespace App\Models\Recruiter;


use App\Models\Recruiter;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetRecruiter
{
    public static function getRecruiterById(string $id)
    {
        try {
            return Recruiter::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}