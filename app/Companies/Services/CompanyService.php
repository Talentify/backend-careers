<?php

namespace App\Companies\Services;

use App\Companies\Models\Company;

/**
 * Class CompanyService
 * @package App\Companies\Services
 */
class CompanyService
{
    /**
     * @return mixed
     */
    public function findAll()
    {
        return Company::withTrashed()
            ->get();
    }

    /**
     * @param int $id
     * @return Company
     */
    public function findById(int $id)
    {
        return Company::withoutTrashed()
            ->findOrFail($id);
    }

    /**
     * @param array $data
     * @return Company
     */
    public function store(array $data): Company
    {
        $company = new Company;
        $company->company = $data['company'];
        $company->about = $data['about'] ?? null;
        $company->link = $data['link'] ?? null;
        $company->save();
        return $company;
    }

    /**
     * @param Company $company
     * @param array $data
     * @return Company
     */
    public function update(Company $company, array $data): Company
    {
        $company->company = $data['company'];
        $company->about = $data['about'] ?? null;
        $company->link = $data['link'] ?? null;
        $company->save();
        return $company;
    }

    /**
     * @param Company $company
     * @return Company
     */
    public function enable(Company $company): Company
    {
        $company->restore();
        return $company;
    }

    /**
     * @param Company $company
     * @return Company
     * @throws \Exception
     */
    public function disable(Company $company)
    {
        $company->delete();
        return $company;
    }

    /**
     * @param Company $company
     * @return null
     */
    public function destroy(Company $company)
    {
        $company->forceDelete();
        return null;
    }
}
