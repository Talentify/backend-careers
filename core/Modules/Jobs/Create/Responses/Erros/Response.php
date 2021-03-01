<?php

namespace Recruitment\Modules\Jobs\Create\Responses\Erros;

use Recruitment\Modules\Jobs\Create\Presenters\Responses\Errors\ResponsePresenter;
use Recruitment\Modules\Jobs\Create\Responses\ResponseInterface;
use Recruitment\Modules\Jobs\Create\Responses\Status;

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
