<?php


namespace App\Services;


use App\Repositories\Contracts\CompanyRepositoryInterface;

class CompanyService
{
    private $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function index(int $per_page)
    {
        return $this->companyRepository->orderBy('name', 'ASC')->paginate($per_page);
    }

    public function show($id)
    {
        return $this->companyRepository->findWhereFirst("id", $id);
    }

    public function store($request)
    {
        $company = $this->companyRepository->store($request->all());

        if (!$company)
            return false;

        return true;
    }

    public function update($id, $request)
    {
        if(!isset($request['name']))
            return false;

        return $this->companyRepository->update($id, $request);
    }

    public function delete($id)
    {
        return $this->companyRepository->delete($id);
    }
}
