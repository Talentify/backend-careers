<?php

namespace Modules\Jobs\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Jobs\Repositories\JobsRepositoryInterface;

class JobsController extends Controller
{
    /**
     * @var JobsRepositoryInterface
     */
    private $repository;

    public function __construct(JobsRepositoryInterface $jobsRepositoryInterface)
    {
        $this->repository = $jobsRepositoryInterface;
    }

    public function list()
    {
        return $this->repository->listOpenJobs();
    }

    public function createNewJob()
    {
        $requestBody = request()->all();

        $createdJob = $this->repository->createNewJob($requestBody);

        if ($createdJob) {
            return response()->json([
                'message' => 'Created',
                'data' => $createdJob,
            ]);
        }

        return response()->json([
            'message' => 'Validation Errors',
            'errors' => $this->repository->getErrors(),
        ], 400);
    }
}
