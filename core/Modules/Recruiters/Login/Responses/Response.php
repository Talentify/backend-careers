<?php

namespace Recruitment\Modules\Recruiters\Login\Responses;

use Recruitment\Modules\Recruiters\Login\Entities\Recruiter;
use Recruitment\Modules\Recruiters\Login\Presenters\Responses\ResponsePresenter;

class Response implements ResponseInterface
{
    private $status;
    private $recruiter;

    public function __construct(Status $status, Recruiter $recruiter)
    {
        $this->status = $status;
        $this->recruiter = $recruiter;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getRecruiter(): Recruiter
    {
        return $this->recruiter;
    }

    public function getPresenter(): ResponsePresenter
    {
        return (new ResponsePresenter($this))->present();
    }
}
