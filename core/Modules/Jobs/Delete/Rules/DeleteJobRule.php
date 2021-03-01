<?php

namespace Recruitment\Modules\Jobs\Delete\Rules;

use Recruitment\Modules\Jobs\Delete\Gateways\DeleteJobGateway;
use Recruitment\Modules\Jobs\Delete\Requests\Request;

class DeleteJobRule
{
    private $deleteJobGateway;
    private $request;

    public function __construct(DeleteJobGateway $deleteJobGateway, Request $request)
    {
        $this->deleteJobGateway = $deleteJobGateway;
        $this->request = $request;
    }

    public function apply(): void
    {
        $this->deleteJobGateway->delete($this->request);
    }
}
