<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Services\JobsService;
use App\Services\UsersService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BaseController extends Controller
{
    /**
     * @var JobsService|null
     */
    private $jobsService = null;

    /**
     * BaseController constructor.
     * @param JobsService $jobsService
     */
    public function __construct(JobsService $jobsService)
    {
        $this->jobsService = $jobsService;
    }

    /**
     * @description Show all active jobs
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        try {
            $jobs = $this->jobsService->getJobsActiveWithPaginate(15);

            if ($jobs instanceof ModelNotFoundException) {
                throw $jobs;
            }

            return view(
                'base.jobs.index',
                [
                    'user_logged' => UsersService::checkUserLogged(),
                    'user_admin' => UsersService::checkUserAdmin(),
                    'jobs' => $jobs,
                    'qtd' => $jobs->total()
                ]
            );
        } catch (ModelNotFoundException $e) {
            $msg = 'Arquivo: ' . $e->getFile() . ' Linha: ' . $e->getLine() . ' - Mensagem: ' . $e->getMessage();
            return UnavailableController::unavailable($msg);
        }
    }
}
