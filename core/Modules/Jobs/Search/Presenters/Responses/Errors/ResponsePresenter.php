<?php

namespace Recruitment\Modules\Jobs\Search\Presenters\Responses\Errors;

use Recruitment\Modules\Jobs\Search\Responses\Errors\Response;

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
            'error' => $this->response->getError()
        ];
        return $this;
    }

    public function toArray(): array
    {
        return $this->presenter;
    }
}
