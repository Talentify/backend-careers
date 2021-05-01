<?php

namespace App\Domain\Companies\Controller;

use App\Domain\Companies\Service\CompanyService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CompanyController extends Controller
{

    private $service;

        
    /**
     * __construct
     *
     * @param  mixed $service
     * @return void
     */
    public function __construct(CompanyService $service)
    {
        $this->service = $service;    
    }
        
    /**
     * index
     *
     * @param  mixed $filters
     * @return void
     */
    public function index(Request $filters)
    {
        $companies = $this->service->getAll($filters);
        return response()->json(['data' => $companies], Response::HTTP_OK);
    }
        
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => "required"
            ]);

            $company = $this->service->create($request->all());
            return response()->json(['data' => $company], Response::HTTP_OK);
        
        } catch (ValidationException $e) {
            return response()->json(['erros' => $e->errors()], Response::HTTP_UNAUTHORIZED);
        } catch (\Exception $e) {
            return response()->json(['erros' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }
}