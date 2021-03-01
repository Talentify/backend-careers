<?php

namespace Recruitment\Modules\Jobs\Search\Responses;

use Recruitment\Modules\Jobs\Search\Collections\JobCollection;
use Recruitment\Modules\Jobs\Search\Presenters\Responses\ResponsePresenter;

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
