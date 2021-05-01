<?php

namespace App\Domain\Recruiters\Controller;

use App\Domain\Recruiters\Service\RecruiterService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Str;

class RecruiterController extends Controller
{

    private $service;
    
    /**
     * __construct
     *
     * @param  mixed $service
     * @return void
     */
    public function __construct(RecruiterService $service)
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
        $vacancies = $this->service->getAll($filters);
        return response()->json(['data' => $vacancies], Response::HTTP_OK);
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
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'company_id' => 'required|exists:companies,id'
            ]);

            $request->merge([
                'password' => Hash::make($request->password)
            ]);

            $recruiter = $this->service->create($request->all());
            return response()->json(['data' => $recruiter], Response::HTTP_OK);
        
        } catch (ValidationException $e) {
            return response()->json(['erros' => $e->errors()], Response::HTTP_UNAUTHORIZED);
        } catch (\Exception $e) {
            return response()->json(['erros' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }
}