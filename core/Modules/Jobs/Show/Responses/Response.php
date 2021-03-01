<?php

namespace Recruitment\Modules\Jobs\Show\Responses;

use Recruitment\Modules\Jobs\Show\Entities\Job;
use Recruitment\Modules\Jobs\Show\Presenters\Responses\ResponsePresenter;

class Response implements ResponseInterface
{
    private $status;
    private $job;

    public function __construct(Status $status, Job $job)
    {
        $this->status = $status;
        $this->job = $job;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getJob(): Job
    {
        return $this->job;
    }

    public function getPresenter(): ResponsePresenter
    {
        return (new ResponsePresenter($this))->present();
    }
}
