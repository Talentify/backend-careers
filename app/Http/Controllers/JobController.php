<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobFormRequest;
use App\Models\Job;
use App\Services\JobService;
use Illuminate\Http\Request;

class JobController extends Controller
{
    private $jobService;

    public function __construct(JobService $jobService) {
        $this->jobService = $jobService;
    }

    public function index(Request $request)
    {
        return response()->json($this->jobService->loadAll($request));
    }

    public function show(int $id)
    {
        return response()->json($this->jobService->find($id));
    }

    public function store(JobFormRequest $request)
    {
        return response()->json($this->jobService->save($request), 201);
    }

    public function update(JobFormRequest $request, Job $job)
    {
        return response()->json($this->jobService->save($request, $job));
    }

    public function destroy(int $id)
    {
        return response()->json($this->jobService->delete($id));
    }

}
