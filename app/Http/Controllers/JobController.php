<?php


namespace App\Http\Controllers;

use App\Services\Job\JobService;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function create(Request $request, JobService $service)
    {
        $recruiter = $request->user();
        $job = $service->create(array_merge($request->all(), [
            'company_id' => $recruiter->company_id,
            'recruiter_id' => $recruiter->id
        ]));

        return response()->json(['data' => $job], 201);
    }

    public function update(int $jobId, Request $request, JobService $service)
    {
        $recruiter = $request->user();
        $updateAction = $service->update($jobId, $recruiter->id, $request->all());

        return response()->json(['data' => $updateAction]);
    }

    public function search(Request $request, JobService $service)
    {
        $jobs = $service->search($request->all());

        return response()->json(['data' => $jobs]);
    }
}
