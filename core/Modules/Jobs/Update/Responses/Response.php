<?php

namespace Recruitment\Modules\Jobs\Update\Responses;

use Recruitment\Modules\Jobs\Update\Entities\Job;
use Recruitment\Modules\Jobs\Update\Presenters\Responses\ResponsePresenter;

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
