<?php

namespace App\Domain\Jobs\Controllers;

use App\Domain\Jobs\Requests\JobRequest;
use App\Domain\Jobs\Services\CreateJobService;
use App\Domain\Shared\Traits\ExecuteService;
use App\Http\Controllers\Controller;
use Infrastructure\Jobs\Repositories\Facades\JobRepository;

class JobController extends Controller
{
    use ExecuteService;

    public function index()
    {
        return JobRepository::findActiveJobs();
    }

    public function store(JobRequest $request, CreateJobService $service)
    {
        $user = $this->execute($service, $request->all());
        return response()->json($user, 201);
    }
}
