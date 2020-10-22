<?php

namespace Modules\Jobs\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
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

    public function addNewJob()
    {
        return [];
    }
}
