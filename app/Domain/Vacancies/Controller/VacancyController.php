<?php

namespace App\Domain\vacancies\Controller;

use App\Domain\Vacancies\Service\VacancyService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class VacancyController extends Controller
{

    private $service;

    public function __construct(VacancyService $service)
    {
        $this->middleware("auth:api")->except("index");
        $this->service = $service;    
    }

    public function index(Request $filters)
    {
        $vacancies = $this->service->getAll($filters->all());
        return response()->json(['data' => $vacancies], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'descripton' => 'required',
                'address' => 'required',
                'salary' => 'required',
                'company' => 'required'
            ]);

            $request->merge([
                'recruiter_id' => auth()->user()->id,
                'status' => 1
            ]);
            
            $vacancy = $this->service->create($request->all());

            return response()->json(['data' => $vacancy], Response::HTTP_OK);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], Response::HTTP_UNAUTHORIZED);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required',
                'descripton' => 'required',
                'address' => 'required',
                'salary' => 'required',
                'company' => 'required'
            ]);

            $request->except("recruiter_id");
            
            $vacancy = $this->service->update($request->all(), $id);

            return response()->json(['data' => $vacancy], Response::HTTP_OK);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], Response::HTTP_UNAUTHORIZED);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        try {
            $vacancy = $this->service->delete($id);

            return response()->json(['data' => $vacancy], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }
}