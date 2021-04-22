<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecruiterRequest;
use App\Http\Resources\RecruiterResource;
use App\Services\RecruiterService;
use Illuminate\Http\Request;

class RecruiterController extends Controller
{
    private $recruiterService;

    public function __construct(RecruiterService $recruiterService)
    {
        $this->recruiterService = $recruiterService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $per_page = (int) $request->get('per_page', 15);
        $recruiters = $this->recruiterService->index($per_page);

        return RecruiterResource::collection($recruiters);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecruiterRequest $request)
    {
        $recruiter = $this->recruiterService->store($request);

        if (!$recruiter) {
            return response()->json(["error" => "Not Saved."], '500');
        }

        return response()->json(["success" => "Recruiter Created!"], '201');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!filter_var($id, FILTER_VALIDATE_INT))
            return response()->json(['error' => 'ID deve ser um número.'], 500);

        $recruiter = $this->recruiterService->show($id);

        if(!$recruiter) {
            return response()->json([
                'error'   => 'Recruiter Not Found.',
            ], 404);
        }

        return new RecruiterResource($recruiter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
