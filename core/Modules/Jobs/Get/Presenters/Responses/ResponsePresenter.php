<?php

namespace Recruitment\Modules\Jobs\Get\Presenters\Responses;

use Recruitment\Modules\Jobs\Get\Presenters\JobCollectionPresenter;
use Recruitment\Modules\Jobs\Get\Responses\Response;

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
            'data' => (new JobCollectionPresenter($this->response->getJobCollection()))->present()->toArray()
        ];
        return $this;
    }

    public function toArray(): array
    {
        return $this->presenter;
    }
}
