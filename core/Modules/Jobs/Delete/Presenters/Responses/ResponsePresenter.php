<?php

namespace Recruitment\Modules\Jobs\Delete\Presenters\Responses;

use Recruitment\Modules\Jobs\Delete\Responses\Response;

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
            'message' => $this->response->getMessage()
        ];
        return $this;
    }

    public function toArray(): array
    {
        return $this->presenter;
    }
}
