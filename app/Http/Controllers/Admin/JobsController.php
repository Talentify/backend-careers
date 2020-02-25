<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Services\JobsService;
use App\Http\Requests\Admin\Jobs as JobsRequest;
use App\Services\UsersService;

/**
 * Class JobsController
 * @package App\Http\Controllers\Admin
 */
class JobsController extends Controller
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
     * @description Show the quantity about jobs
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function dashboard()
    {
        try {
            if (UsersService::checkUserAdmin()) {
                $qtsJobsActived = $this->jobsService->getTotalActiveJobs();
                $qtsJobsInactived = $this->jobsService->getTotalInactiveJobs();

                return view(
                    'admin.dashboard',
                    [
                        'actived' => (int)$qtsJobsActived,
                        'inactived' => (int)$qtsJobsInactived,
                        'user_logged' => 'true'
                    ]
                );
            } else {
                return redirect()->route('base.jobs');
            }
        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * @description List the jobs (Active and Inactive)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        try {
            if (UsersService::checkUserAdmin()) {
                $jobs = $this->jobsService->getAllJobs();

                return view(
                    'admin.jobs.index',
                    [
                        'jobs' => $jobs
                    ]
                );
            } else {
                return redirect()->route('base.jobs');
            }
        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * @description Show the form for create a new job
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        if (UsersService::checkUserAdmin()) {
            return view('admin.jobs.create');
        } else {
            return redirect()->route('base.jobs');
        }
    }

    /**
     * @description
     * @param JobsRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(JobsRequest $request)
    {
        try {
            if (UsersService::checkUserAdmin()) {
                $job = [
                    'uuid' => Str::uuid()->toString(),
                    'company' => $request->company,
                    'title' => $request->title,
                    'description' => htmlspecialchars($request->description),
                    'status' => $request->status,
                    'salary' => $request->salary,
                    'workplace' => $request->workplace,
                    'contact' => $request->contact
                ];

                $this->jobsService->createJob($job);

                return back()->with('success', 'Vaga cadastrada com sucesso!');
            } else {
                return redirect()->route('base.jobs');
            }
        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param $id
     */
    public function show($id)
    {
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($uuid)
    {
        try {
            if (UsersService::checkUserAdmin()) {
                $job = $this->jobsService->getJobByUuid($uuid);

                if ($job instanceof ModelNotFoundException) {
                    throw new ModelNotFoundException('Não foi possível localizar a vaga pelo código informado.');
                }

                return view(
                    'admin.jobs.edit',
                    [
                        'job' => $job
                    ]
                );
            } else {
                return redirect()->route('base.jobs');
            }
        } catch (ModelNotFoundException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param JobsRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(JobsRequest $request, $uuid)
    {
        try {
            if (UsersService::checkUserAdmin()) {
                $job = $this->jobsService->getJobByUuid($uuid);

                if ($job instanceof ModelNotFoundException) {
                    throw new ModelNotFoundException('Não foi possível atualizar a vaga pelo código informado.');
                }

                $job->fill($request->all());
                $job->save();

                return redirect()->route('admin.jobs.index')->with('success', 'Vaga atualizada com sucesso!');
            } else {
                return redirect()->route('base.jobs');
            }
        } catch (ModelNotFoundException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
    }
}
