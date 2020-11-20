<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobVacanciesRequest;
use App\Services\JobVacanciesService;
use Illuminate\Http\Request;

class JobVacanciesController extends Controller
{
    private $vacancieService;

    public function __construct(JobVacanciesService $vacancieService)
    {
        $this->vacancieService = $vacancieService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vacancie = $this->vacancieService->list($request);

        return response()->json($vacancie, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(JobVacanciesRequest $request)
    {
        $vacancie = $this->vacancieService->create($request);

        return response()->json($vacancie, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vacancie = $this->vacancieService->show($id);
        if ($vacancie) {
            return response()->json($vacancie, 200);
        }

        return response()->json(['errors' => 'Not Found'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vacancie = $this->vacancieService->update($id, $request);
        if ($vacancie) {
            return response()->json($vacancie, 200);
        }

        return response()->json(['errors' => 'Not Found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vacancie = $this->vacancieService->destroy($id);
        if ($vacancie) {
            return response()->json($vacancie, 204);
        }

        return response()->json(['errors' => 'Not Found'], 404);
    }
}
