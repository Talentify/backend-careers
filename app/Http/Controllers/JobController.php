<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\JobRequest;
use App\Http\Resources\JobResource;
use App\Repositories\JobRepository;

class JobController extends Controller
{
    public function __construct(JobRepository $repository = null)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return JobResource::collection($this->repository->findAll());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function openJobs()
    {
        return JobResource::collection($this->repository->findAllOpen());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\JobRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        return new JobResource($this->repository->create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new JobResource($this->repository->findById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\JobRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobRequest $request, $id)
    {
        return new JobResource($this->repository->update($id, $request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return new JobResource($this->repository->delete($id));
    }
}
