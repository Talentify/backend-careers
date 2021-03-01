<?php

namespace App\Repositories;

use App\Models\Job;
use Recruitment\Modules\Jobs\Create\Exceptions\CreateJobException;
use Recruitment\Modules\Jobs\Create\Gateways\CreateJobGateway;
use Recruitment\Modules\Jobs\Create\Presenters\KeywordPresenter;
use Recruitment\Modules\Jobs\Create\Requests\Request as CreateRequest;
use Recruitment\Modules\Jobs\Create\Entities\Job as CreateJob;
use Recruitment\Modules\Jobs\Delete\Exceptions\DeleteJobException;
use Recruitment\Modules\Jobs\Delete\Gateways\DeleteJobGateway;
use Recruitment\Modules\Jobs\Delete\Requests\Request;
use Recruitment\Modules\Jobs\Get\Collections\JobCollection;
use Recruitment\Modules\Jobs\Get\Exceptions\GetJobException;
use Recruitment\Modules\Jobs\Search\Exceptions\FindJobException;
use Recruitment\Modules\Jobs\Search\Gateways\FindJobGateway;
use Recruitment\Modules\Jobs\Show\Entities\Address;
use Recruitment\Modules\Jobs\Show\Exceptions\GetJobException as ShowGetJobException;
use Recruitment\Modules\Jobs\Show\Gateways\GetJobGateway as ShowGetJobGateway;
use Recruitment\Modules\Jobs\Update\Entities\Address as UpdateAddress;
use Recruitment\Modules\Jobs\Update\Exceptions\JobNotFoundException;
use Recruitment\Modules\Jobs\Update\Exceptions\UpdateJobException;
use Recruitment\Modules\Jobs\Update\Gateways\GetJobGateway as UpdateGetOrderGateway;
use Recruitment\Modules\Jobs\Update\Gateways\UpdateJobGateway;
use Recruitment\Modules\Jobs\Update\Requests\Request as UpdateRequest;
use Recruitment\Modules\Jobs\Update\Entities\Job as UpdateJob;
use Recruitment\Modules\Jobs\Show\Requests\Request as ShowRequest;
use Recruitment\Modules\Jobs\Show\Entities\Job as ShowJob;
use Recruitment\Modules\Jobs\Show\Exceptions\JobNotFoundException as ShowJobNotFoundException;
use Recruitment\Modules\Jobs\Get\Gateways\GetJobGateway;
use Recruitment\Modules\Jobs\Get\Entities\Job as GetJob;
use Recruitment\Modules\Jobs\Get\Entities\Address as GetAddress;
use Recruitment\Modules\Jobs\Search\Requests\Request as SearchRequest;
use Recruitment\Modules\Jobs\Search\Collections\JobCollection as SearchJobCollection;
use Recruitment\Modules\Jobs\Search\Entities\Job as SearchJob;
use Recruitment\Modules\Jobs\Search\Entities\Address as SearchAddress;

class JobRepository implements
    CreateJobGateway,
    UpdateJobGateway,
    DeleteJobGateway,
    ShowGetJobGateway,
    UpdateGetOrderGateway,
    GetJobGateway,
    FindJobGateway
{
    private $model = Job::class;

    public function create(CreateRequest $request): CreateJob
    {
        try {
            $job = $this->model::create(
                [
                    'tittle' => $request->getJob()->getTittle(),
                    'description' => $request->getJob()->getDescription(),
                    'status' => $request->getJob()->getStatus(),
                    'salary' => $request->getJob()->getSalary(),
                    'keywords' => (new KeywordPresenter($request->getJob()->getKeywords()))->present()->toJson(),
                    'recruiter_id' => $request->getJob()->getRecruiterId()
                ]
            );
        } catch (\Exception $exception) {
            throw new CreateJobException($exception->getMessage(), $exception->getCode(), $exception);
        }

        $request->getJob()->getAddress()->setJobId($job->id);
        $address = (new AddressRepository())->create($request->getJob()->getAddress());

        return new CreateJob(
            $job->tittle,
            $job->description,
            $job->status,
            $address,
            $job->salary,
            $job->keywords,
            $job->recruiter_id
        );
    }

    public function update(UpdateRequest $request): UpdateJob
    {
        try {
            $this->model::where('id', $request->getJob()->getId())->update(
                [
                    'tittle' => $request->getJob()->getTittle(),
                    'description' => $request->getJob()->getDescription(),
                    'status' => $request->getJob()->getStatus(),
                    'salary' => $request->getJob()->getSalary(),
                    'keywords' => (new KeywordPresenter($request->getJob()->getKeywords()))->present()->toJson(),
                    'recruiter_id' => $request->getJob()->getRecruiterId()
                ]
            );
        } catch (\Exception $exception) {
            throw new CreateJobException($exception->getMessage(), $exception->getCode(), $exception);
        }

        $request->getJob()->getAddress()->setJobId($request->getJob()->getId());
        (new AddressRepository())->update($request->getJob()->getAddress());

        return new UpdateJob(
            $request->getJob()->getId(),
            $request->getJob()->getTittle(),
            $request->getJob()->getDescription(),
            $request->getJob()->getStatus(),
            (new UpdateAddress(
                $request->getJob()->getAddress()->getAddress(),
                $request->getJob()->getAddress()->getNumber(),
                $request->getJob()->getAddress()->getCity(),
                $request->getJob()->getAddress()->getState(),
                $request->getJob()->getAddress()->getCountry(),
                $request->getJob()->getAddress()->getComplement()
            ))->setJobId($request->getJob()->getId()),
            $request->getJob()->getSalary(),
            $request->getJob()->getKeywords(),
            $request->getJob()->getRecruiterId()
        );
    }

    public function delete(Request $request): void
    {
        (new AddressRepository())->delete($request);
        try {
            $this->model::where('id', $request->getId())->delete();
        } catch (\Exception $exception) {
            throw new DeleteJobException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    public function getJobById(ShowRequest $request): ShowJob
    {
        try {
            $job = $this->model::where('jobs.id', $request->getId())
                ->join('addresses', 'jobs.id', '=', 'addresses.job_id')
                ->first();
        } catch (\Exception $exception) {
            throw new ShowGetJobException($exception->getMessage(), $exception->getCode(), $exception);
        }

        if (is_null($job)) {
            throw new ShowJobNotFoundException('Job not found.', 404);
        }

        return new ShowJob(
            $job->id,
            $job->tittle,
            $job->description,
            $job->status,
            new Address(
                $job->address,
                $job->number,
                $job->city,
                $job->state,
                $job->country,
                $job->complement
            ),
            $job->salary,
            $job->keywords,
            $job->recruiter_id
        );
    }

    public function getRecruiterIdJobById(UpdateRequest $request): ?int
    {
        try {
            $job = $this->model::where('id', $request->getJob()->getId())->first();
        } catch (\Exception $exception) {
            throw new UpdateJobException($exception->getMessage(), $exception->getCode(), $exception);
        }

        if (is_null($job)) {
            throw new JobNotFoundException('Job not found.', 404);
        }
        return $job->recruiter_id;
    }

    public function getJobs(): JobCollection
    {
        try {
            $jobs = $this->model::where('status', 'ACTIVE')
                ->join('addresses', 'jobs.id', '=', 'addresses.job_id')
                ->get();
        } catch (\Exception $exception) {
            throw new GetJobException($exception->getMessage(), $exception->getCode(), $exception);
        }

        $jobCollection = new JobCollection();
        if(!is_null($jobs)) {
            foreach ($jobs as $job) {
                $jobCollection->add(
                    new GetJob(
                        $job->id,
                        $job->tittle,
                        $job->description,
                        $job->status,
                        new GetAddress(
                            $job->address,
                            $job->number,
                            $job->city,
                            $job->state,
                            $job->country,
                            $job->complement
                        ),
                        $job->salary,
                        $job->keywords,
                        $job->recruiter_id
                    )
                );
            }
        }
        return $jobCollection;
    }

    public function findJob(SearchRequest $request): SearchJobCollection
    {
        try {
            $findJobs = $this->model::where('status', 'ACTIVE')
                ->join('addresses', 'jobs.id', '=', 'addresses.job_id')
                ->join('recruiters', 'jobs.recruiter_id', '=', 'recruiters.id')
                ->join('companies', 'companies.id', '=', 'recruiters.company_id');

            if(!is_null($request->getKeywords())) {
                $keywords = explode(',', $request->getKeywords());
                foreach ($keywords as $keyword) {
                    $findJobs->where('jobs.keywords','like', '%' . strtoupper($keyword) . '%');
                }
            }

            if(!is_null($request->getAddressCity())) {
                $findJobs->where('addresses.city', 'like', '%' .  $request->getAddressCity() . '%');
            }

            if(!is_null($request->getAddressState())) {
                $findJobs->where('addresses.state', 'like', '%' . $request->getAddressState() . '%');
            }

            if(!is_null($request->getAddressCountry())) {
                $findJobs->where('addresses.country', 'like', '%' . $request->getAddressCountry() . '%');
            }

            if(!is_null($request->getStartSalary()) && !is_null($request->getEndSalary())) {
                $findJobs->whereBetween('jobs.salary', [$request->getStartSalary(),$request->getEndSalary()]);
            }

            if(!is_null($request->getCompany())) {
                $findJobs->where('companies.name', 'like', '%' . $request->getCompany() . '%');
            }

            $jobs = $findJobs->get();
        } catch (\Exception $exception) {
            throw new FindJobException($exception->getMessage(), $exception->getCode(), $exception);
        }

        $jobCollection = new SearchJobCollection();
        if(!is_null($jobs)) {
            foreach ($jobs as $job) {
                $jobCollection->add(
                    new SearchJob(
                        $job->id,
                        $job->tittle,
                        $job->description,
                        $job->status,
                        new SearchAddress(
                            $job->address,
                            $job->number,
                            $job->city,
                            $job->state,
                            $job->country,
                            $job->complement
                        ),
                        $job->salary,
                        $job->keywords,
                        $job->recruiter_id
                    )
                );
            }
        }
        return $jobCollection;
    }
}
