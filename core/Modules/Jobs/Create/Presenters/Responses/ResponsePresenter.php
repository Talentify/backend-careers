<?php

namespace Recruitment\Modules\Jobs\Create\Presenters\Responses;

use Recruitment\Modules\Jobs\Create\Presenters\JobPresenter;
use Recruitment\Modules\Jobs\Create\Responses\Response;

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
