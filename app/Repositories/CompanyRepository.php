<?php


namespace App\Repositories;


use App\Models\Company;
use App\Repositories\Contracts\CompanyRepositoryInterface;

class CompanyRepository extends BaseRepository implements CompanyRepositoryInterface
{
    public function model()
    {
        return Company::class;
    }
}
