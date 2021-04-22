<?php


namespace App\Repositories;


use App\Models\Recruiter;
use App\Repositories\Contracts\RecruiterRepositoryInterface;

class RecruiterRepository extends BaseRepository implements RecruiterRepositoryInterface
{
    public function model()
    {
        return Recruiter::class;
    }
}
