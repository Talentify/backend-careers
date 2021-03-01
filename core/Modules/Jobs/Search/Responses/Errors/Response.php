<?php

namespace Recruitment\Modules\Jobs\Search\Responses\Errors;

use Recruitment\Modules\Jobs\Search\Presenters\Responses\Errors\ResponsePresenter;
use Recruitment\Modules\Jobs\Search\Responses\ResponseInterface;
use Recruitment\Modules\Jobs\Search\Responses\Status;

class Response implements ResponseInterface
{
    private $status;
    private $error;

    public function __construct(Status $status, string $error)
    {
        $this->status = $status;
        $this->error = $error;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getError(): string
    {
        return $this->error;
    }

    public function getPresenter(): ResponsePresenter
    {
        return (new ResponsePresenter($this))->present();
    }
}
