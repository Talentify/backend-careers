<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobsRequest;
use App\Services\JobsService;
use Illuminate\Http\Response;

class JobsController extends Controller
{
    /**
     * @var JobsService
     */
    private $jobsService;

    /**
     * JobsController constructor.
     * @param JobsService $jobsService
     */
    public function __construct(JobsService $jobsService)
    {
        $this->jobsService = $jobsService;
    }

    /**
     * @param JobsRequest $request
     * @return mixed
     */
    public function create(JobsRequest $request)
    {
        try {
            $jobData = current($request->all());
            $this->jobsService->create($jobData);
            return response()->json([], Response::HTTP_CREATED);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param JobsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listByStatus(JobsRequest $request)
    {
        try {
            $jobs = $this->jobsService->listOpenedJobs($request->input('status'));
            return response()->json($jobs, Response::HTTP_OK);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function list()
    {
        try {
            $jobs = $this->jobsService->list();
            return response()->json($jobs, Response::HTTP_OK);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param JobsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function find(JobsRequest $request)
    {
        try {
            $job = $this->jobsService->find($request->id);
            return response()->json($job, Response::HTTP_OK);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param JobsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(JobsRequest $request)
    {
        try {
            $this->jobsService->update($request->all());
            return response()->json([], Response::HTTP_OK);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param JobsRequest $request
     * @return mixed
     */
    public function delete(JobsRequest $request)
    {
        try {
            $this->jobsService->delete($request->id);
            return response()->json([], Response::HTTP_OK);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}