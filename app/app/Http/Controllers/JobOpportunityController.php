<?php

namespace App\Http\Controllers;

use App\Enums\JobStatus;
use App\Http\Resources\JobResource;
use App\Repositories\Eloquent\JobOpportunityRepository;
use App\Services\JobService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JobOpportunityController extends Controller
{
    protected $jobService;
    protected $jobRepository;

    public function __construct(
        JobService $jobService,
        JobOpportunityRepository $jobRepository
    ) {
        $this->middleware('auth:api', ['except' => ['index', 'view']]);

        $this->jobService = $jobService;
        $this->jobRepository = $jobRepository;
    }

    public function create(Request $request)
    {
        $this->authorize('is_admin');

        $this->validate($request, [
            'company_id'    => 'required|numeric',
            'title'         =>  'required|string|max:256',
            'description'   =>  'required|string|max:1000',
            'salary'        =>  'numeric',
            'status'        =>  ['required', Rule::in([JobStatus::ACTIVE, JobStatus::INACTIVE])],
            'workplace'     =>  'string',
        ]);

        return new JobResource($this->jobService->createJob($request->all()));
    }

    public function index()
    {
        return JobResource::collection($this->jobRepository->all());
    }

    public function view(string $jobId)
    {
        return new JobResource($this->jobRepository->findById($jobId));
    }

    public function update(string $jobId, Request $request)
    {
        $this->authorize('is_admin');

        $this->validate($request, [
            'workplace'     =>  'string',
            'title'         =>  'string|max:256',
            'description'   =>  'string|max:1000',
            'salary'        =>  'numeric',
            'status'        =>  ['required', Rule::in([JobStatus::ACTIVE, JobStatus::INACTIVE])],
        ]);

        return new JobResource(
            $this->jobRepository->update($jobId, $request->except(['company_id']))
        );
    }

    public function delete(string $jobId)
    {
        $this->authorize('is_admin');

        $this->jobRepository->delete($jobId);
        return response([], 204);
    }
}
