<?php

namespace Recruitment\Modules\Jobs\Get\Responses;

use Recruitment\Modules\Jobs\Get\Collections\JobCollection;
use Recruitment\Modules\Jobs\Get\Presenters\Responses\ResponsePresenter;

class Response implements ResponseInterface
{
    private $status;
    private $jobCollection;

    public function __construct(Status $status, JobCollection $jobCollection)
    {
        $this->status = $status;
        $this->jobCollection = $jobCollection;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getJobCollection(): JobCollection
    {
        return $this->jobCollection;
    }

    public function getPresenter(): ResponsePresenter
    {
        return (new ResponsePresenter($this))->present();
    }
}
