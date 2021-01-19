<?php

namespace App\Http\Controllers;

use App\Enums\JobStatus;
use App\Http\Resources\JobResource;
use App\Repositories\Eloquent\JobRepository;
use App\Services\JobService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JobsController extends Controller
{
    protected $jobService;
    protected $jobRepository;

    public function __construct(
        JobService $jobService,
        JobRepository $jobRepository
    ) {
//        $this->middleware('auth:api', ['except' => ['index']]);

        $this->jobService = $jobService;
        $this->jobRepository = $jobRepository;
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'company_id' => 'required|numeric',
            'workplace_id'  =>  'numeric',
            'title'         =>  'required|string|max:256',
            'description'   =>  'required|string|max:1000',
            'salary'        =>  'numeric',
            'status'        =>  ['required', Rule::in([JobStatus::ACTIVE, JobStatus::INACTIVE])],
            'workplace'     =>  'string',
        ]);

        return $this->jobService->createJob($request->all());
    }

    public function index()
    {
        return JobResource::collection($this->jobRepository->all());
    }

    public function update(string $jobId, Request $request)
    {
        $this->validate($request, [
            'workplace_id'  =>  'numeric',
            'workplace'     =>  'string',
            'title'         =>  'required|string|max:256',
            'description'   =>  'required|string|max:1000',
            'salary'        =>  'numeric',
            'status'        =>  ['required', Rule::in([JobStatus::ACTIVE, JobStatus::INACTIVE])],
        ]);

        return $this->jobService->updateJob($jobId, $request->all());
    }

    public function delete(string $jobId)
    {
        $this->jobRepository->delete($jobId);
        return response([], 204);
    }
}
