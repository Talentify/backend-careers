<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobResource;
use App\Repositories\Contracts\JobRepositoryInterface;
use App\Services\JobService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JobController extends Controller
{

    protected $service;

    protected $repository;

    public function __construct(JobService $service, JobRepositoryInterface $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return JobResource::collection($this->repository->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->service->create($request);
        if ($result['success']) {
            return new JobResource($result['data']);
        } else {
            return response()->json(['error' => $result['message']], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->service->find($id);
        if ($result['success']) {
            return new JobResource($result['data']);
        } else {
            return response()->json(['error' => $result['message']], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
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
        $result = $this->service->update($request, $id);
        if ($result['success']) {
            return new JobResource($result['data']);
        } else {
            return response()->json(['error' => $result['message']], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);
        if ($result['success']) {
            return response()->json(['message' => $result['message']], Response::HTTP_OK);
        } else {
            return response()->json(['error' => $result['message']], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
