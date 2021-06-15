<?php

namespace App\Jobs\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\Services\JobService;
use App\Jobs\Models\Job;
use App\Jobs\Requests\JobRequest;
use App\Jobs\Resources\JobResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class JobController
 * @package App\Jobs\Controllers\Api
 */
class JobController extends Controller
{
    /**
     * @var JobService
     */
    private $service;

    /**
     * JobController constructor.
     * @param JobService $service
     */
    public function __construct(JobService $service)
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
        return JobResource::collection($list);
    }

    /**
     * @param JobRequest $request
     * @return JsonResponse
     */
    public function store(JobRequest $request)
    {
        $job = $this->service->store($request->validated());
        return response()->json($job, Response::HTTP_OK);
    }

    /**
     * @param Job $job
     * @return JsonResponse
     */
    public function show(Job $job)
    {
        return response()->json($job, Response::HTTP_OK);
    }

    /**
     * @param JobRequest $request
     * @param Job $job
     * @return JsonResponse
     */
    public function update(JobRequest $request, Job $job)
    {
        $job = $this->service->update($job, $request->validated());
        return response()->json($job, Response::HTTP_OK);
    }

    /**
     * @param Job $job
     * @return JsonResponse
     */
    public function enable(Job $job)
    {
        $job = $this->service->enable($job);
        return response()->json($job, Response::HTTP_OK);
    }

    /**
     * @param Job $job
     * @return JsonResponse
     */
    public function disable(Job $job)
    {
        $this->authorize('disable', $job);
        $job = $this->service->disable($job);
        return response()->json($job, Response::HTTP_OK);
    }

    /**
     * @param Job $job
     * @return JsonResponse
     */
    public function destroy(Job $job)
    {
        $this->authorize('destroy', $job);
        $this->service->destroy($job);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
