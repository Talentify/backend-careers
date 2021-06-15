<?php

namespace App\Companies\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Companies\Services\CompanyService;
use App\Companies\Models\Company;
use App\Companies\Requests\CompanyRequest;
use App\Companies\Resources\CompanyResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class CompanyController
 * @package App\Companies\Controllers\Api
 */
class CompanyController extends Controller
{
    /**
     * @var CompanyService
     */
    private $service;

    /**
     * CompanyController constructor.
     * @param CompanyService $service
     */
    public function __construct(CompanyService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $list = $this->service->findAll();
        return CompanyResource::collection($list);
    }

    /**
     * @param CompanyRequest $request
     * @return JsonResponse
     */
    public function store(CompanyRequest $request)
    {
        $company = $this->service->store($request->validated());
        return response()->json($company, Response::HTTP_OK);
    }

    /**
     * @param Company $company
     * @return JsonResponse
     */
    public function show(Company $company)
    {
        return response()->json($company, Response::HTTP_OK);
    }

    /**
     * @param CompanyRequest $request
     * @param Company $company
     * @return JsonResponse
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $company = $this->service->update($company, $request->validated());
        return response()->json($company, Response::HTTP_OK);
    }

    /**
     * @param Company $company
     * @return JsonResponse
     */
    public function enable(Company $company)
    {
        $company = $this->service->enable($company);
        return response()->json($company, Response::HTTP_OK);
    }

    /**
     * @param Company $company
     * @return JsonResponse
     * @throws \Exception
     */
    public function disable(Company $company)
    {
        $company = $this->service->disable($company);
        return response()->json($company, Response::HTTP_OK);
    }

    /**
     * @param Company $company
     * @return JsonResponse
     */
    public function destroy(Company $company)
    {
        $this->service->destroy($company);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
