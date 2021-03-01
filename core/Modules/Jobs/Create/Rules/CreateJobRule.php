<?php

namespace Recruitment\Modules\Jobs\Create\Rules;

use Recruitment\Modules\Jobs\Create\Entities\Job;
use Recruitment\Modules\Jobs\Create\Gateways\CreateJobGateway;
use Recruitment\Modules\Jobs\Create\Requests\Request;

class CreateJobRule
{
    private $createJobGateway;
    private $request;

    public function __construct(CreateJobGateway $createJobGateway, Request $request)
    {
        $this->createJobGateway = $createJobGateway;
        $this->request = $request;
    }

    public function apply(): Job
    {
        return $this->createJobGateway->create($this->request);
    }
}
