<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreJob;
use App\Services\JobService;
use Illuminate\Http\JsonResponse;

class JobController extends Controller
{

    protected $jobService;

    public function __construct(
        JobService $jobService
    ) {
        $this->jobService = $jobService;
    }

    /**
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $data = $this->jobService->getAll();
            return $this->returnSuccess('Success', $data);
        } catch (\Exception $ex) {
            return $this->returnException($ex);
        }
    }

    /**
     *
     * @param  StoreJob $request
     * @return JsonResponse
     */
    public function store(StoreJob $request): JsonResponse
    {
        try {
            $jobCreated = $this->jobService->store($request->all());
            return $this->returnSuccess('Entity created', $jobCreated, 201);
        } catch (\Exception $ex) {
            return $this->returnException($ex);
        }
    }

    /**
     *
     * @param  type $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        try {
            $job = $this->jobService->getByID($id);
            return $this->returnSuccess('Success', $job);
        } catch (\Exception $ex) {
            return $this->returnException($ex);
        }
    }

    /**
     * @return array
     */
    public function available(): JsonResponse
    {

        try {
            $data = $this->jobService->getAllAvailable();
            return $this->returnSuccess('Success', $data);
        } catch (\Exception $ex) {
            return $this->returnException($ex);
        }
    }

}
