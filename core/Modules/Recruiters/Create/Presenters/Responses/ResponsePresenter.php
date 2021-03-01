<?php

namespace Recruitment\Modules\Recruiters\Create\Presenters\Responses;

use Recruitment\Modules\Recruiters\Create\Presenters\RecruiterPresenter;
use Recruitment\Modules\Recruiters\Create\Responses\Response;

class ResponsePresenter
{
    private $response;
    private $presenter;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function present(): self
    {
        $this->presenter = [
            'status' => [
                'code' => $this->response->getStatus()->getCode(),
                'message' => $this->response->getStatus()->getMessage()
            ],
            'data' => (new RecruiterPresenter($this->response->getRecruiter()))->present()->toArray()
        ];
        return $this;
    }

    public function toArray(): array
    {
        return $this->presenter;
    }
}
