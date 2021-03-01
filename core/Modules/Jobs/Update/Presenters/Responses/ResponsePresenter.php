<?php

namespace Recruitment\Modules\Jobs\Update\Presenters\Responses;

use Recruitment\Modules\Jobs\Update\Presenters\JobPresenter;
use Recruitment\Modules\Jobs\Update\Responses\Response;

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
            'data' => (new JobPresenter($this->response->getJob()))->present()->toArray()
        ];
        return $this;
    }

    public function toArray(): array
    {
        return $this->presenter;
    }
}
