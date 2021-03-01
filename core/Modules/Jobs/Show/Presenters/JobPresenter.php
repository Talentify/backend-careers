<?php

namespace Recruitment\Modules\Jobs\Show\Presenters;

use Recruitment\Modules\Jobs\Show\Entities\Job;

class JobPresenter
{
    private $job;
    private $presenter;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    public function present(): self
    {
        $this->presenter = [
            'id' => $this->job->getId(),
            'tittle' => $this->job->getTittle(),
            'description' => $this->job->getDescription(),
            'status' => $this->job->getStatus(),
            'address' => (new AddressPresenter($this->job->getAddress()))->present()->toArray(),
            'salary' => $this->job->getSalary(),
            'keywords' => $this->job->getKeywords(),
            'recruiterId' => $this->job->getRecruiterId(),
        ];
        return $this;
    }

    public function toArray(): array
    {
        return $this->presenter;
    }
}
