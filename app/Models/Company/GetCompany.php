<?php


namespace App\Models\Company;


use App\Models\Company;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetCompany
{
    public static function getCompanyById(string $id)
    {
        try {
            return Company::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}