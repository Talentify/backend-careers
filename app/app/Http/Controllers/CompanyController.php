<?php

namespace App\Http\Controllers;

use App\Enums\CompanySizeEnum;
use App\Http\Resources\CompanyResource;
use App\Repositories\CompanyRepositoryInterface;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{

    protected $companyRepository;
    protected $companyService;

    public function __construct(
        CompanyRepositoryInterface $companyRepository,
        CompanyService $companyService
    ) {
        $this->companyRepository = $companyRepository;
        $this->companyService = $companyService;
    }

    public function index()
    {
        return CompanyResource::collection($this->companyRepository->all());
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name'  =>  'required|string|max:100',
            'description'   =>  'required|max:1000',
            'size'          =>  [
                'required',
                Rule::in([CompanySizeEnum::LARGE, CompanySizeEnum::MEDIUM, CompanySizeEnum::SMALL])
            ]
        ]);

        $company = $this->companyRepository->create($request->only(['name', 'description', 'size']));

        return new CompanyResource($company);
    }

    public function view(string $companyId)
    {
        return new CompanyResource($this->companyRepository->findById($companyId));
    }

    public function update(string $companyId, Request $request)
    {
        $this->validate($request, [
            'name'  =>  'required|string|max:100',
            'description'   =>  'required|max:1000',
            'size'          =>  [
                'required',
                Rule::in([CompanySizeEnum::LARGE, CompanySizeEnum::MEDIUM, CompanySizeEnum::SMALL])
            ]
        ]);

        $company = $this->companyRepository->update($companyId, $request->only(['name', 'description', 'size']));

        return new CompanyResource($company);
    }

    public function delete(string $companyId)
    {
        $this->companyService->delete($companyId);
        return response([], 204);
    }
}
