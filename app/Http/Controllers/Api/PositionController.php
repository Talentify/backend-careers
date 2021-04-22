<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PositionRequest;
use App\Http\Resources\PositionResource;
use App\Services\PositionService;
use Illuminate\Http\Request;
use function response;

class PositionController extends Controller
{
    private $positionService;

    public function __construct(PositionService $positionService)
    {
        $this->positionService = $positionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = (int) $request->get('per_page', 15);
        $positions = $this->positionService->index($per_page);

        return PositionResource::collection($positions);
    }

    public function listOpenPositions(Request $request)
    {
        $per_page = (int) $request->get('per_page', 15);
        $positions = $this->positionService->listOpenPositions($per_page);

        return PositionResource::collection($positions);
    }

    public function searchOpenPositions(Request $request)
    {
        $per_page = (int) $request->get('per_page', 15);
        $positions = $this->positionService->searchOpenPositions($per_page, $request);

        //return $positions;

        return PositionResource::collection($positions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PositionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PositionRequest $request)
    {
        $position = $this->positionService->store($request);

        if (!$position) {
            return response()->json(["error" => "Not Saved."], '500');
        }

        return response()->json(["success" => "Position Created!"], '201');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|PositionResource
     */
    public function show($id)
    {
        if (!filter_var($id, FILTER_VALIDATE_INT))
            return response()->json(['error' => 'ID deve ser um número.'], 500);

        $position = $this->positionService->show($id);

        if(!$position) {
            return response()->json([
                'error'   => 'Position Not Found.',
            ], 404);
        }

        return new PositionResource($position);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PositionRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PositionRequest $request, $id)
    {
        if (!filter_var($id, FILTER_VALIDATE_INT))
            return response()->json(['error' => 'ID must be a number.'], 400);

        $update = $this->positionService->update($id, $request);

        if($update === 'notFound')
            return response()->json(['error' => 'Position Not Found.'], 404);

        if($update === 'notAuthorized')
            return response()->json(['error' => 'This Recruiter is Not Allowed to Update this Position.'], 401);

        if($update)
            return response()->json(['success' => 'Position Updated!'], 200);

        return response()->json(['error' => 'Position Not Updated.'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id, Request $request)
    {
        if (!filter_var($id, FILTER_VALIDATE_INT))
            return response()->json(['error' => 'ID must be a number.'], 400);

        $deleted = $this->positionService->delete($id, $request);

        if($deleted === 'notFound')
            return response()->json(['error' => 'Position Not Found.'], 404);

        if($deleted === 'notAuthorized')
            return response()->json(['error' => 'This Recruiter is Not Allowed to Delete this Position.'], 401);

        if($deleted) {
            return response()->json(['success' => 'Position Deleted.'], 200);
        }

        return response()->json(['error' => 'Position Not Deleted.'], 500);
    }
}
