<?php

namespace Recruitment\Modules\Jobs\Get\Presenters;

use Recruitment\Modules\Jobs\Get\Collections\JobCollection;

class JobCollectionPresenter
{
    private $jobs;
    private $presenter;

    public function __construct(JobCollection $jobs)
    {
        $this->jobs = $jobs;
    }

    public function present(): JobCollectionPresenter
    {
        $jobs = [];
        foreach ($this->jobs->all() as $job) {
            array_push($jobs, [
                'id' => $job->getId(),
                'tittle' => $job->getTittle(),
                'description' => $job->getDescription(),
                'status' => $job->getStatus(),
                'address' => (new AddressPresenter($job->getAddress()))->present()->toArray(),
                'salary' => $job->getSalary(),
                'keywords' => $job->getKeywords(),
                'recruiterId' => $job->getRecruiterId(),
            ]);
        }
        $this->presenter = $jobs;
        return $this;
    }

    public function toArray(): array
    {
        return $this->presenter;
    }
}
