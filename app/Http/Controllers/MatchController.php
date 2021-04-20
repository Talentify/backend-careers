<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchFormRequest;
use App\Models\Match;
use App\Services\MatchService;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    private $matchService;

    public function __construct(MatchService $matchService) {
        $this->matchService = $matchService;
    }

    public function index(Request $request)
    {
        return response()->json($this->matchService->loadAll($request));
    }

    public function show(int $id)
    {
        return response()->json($this->matchService->find($id));
    }

    public function store(MatchFormRequest $request)
    {
        return response()->json($this->matchService->save($request), 201);
    }

    public function update(MatchFormRequest $request, Match $match)
    {
        return response()->json($this->matchService->save($request, $match));
    }

    public function destroy(int $id)
    {
        return response()->json($this->matchService->delete($id));
    }

}
