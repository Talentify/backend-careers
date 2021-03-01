<?php

namespace Recruitment\Modules\Jobs\Show\Rules;

use Recruitment\Modules\Jobs\Show\Entities\Job;
use Recruitment\Modules\Jobs\Show\Gateways\GetJobGateway;
use Recruitment\Modules\Jobs\Show\Requests\Request;

class GetJobRule
{
    private $getJobGateway;
    private $request;

    public function __construct(GetJobGateway $getJobGateway, Request $request)
    {
        $this->getJobGateway = $getJobGateway;
        $this->request = $request;
    }

    public function apply(): Job
    {
        return $this->getJobGateway->getJobById($this->request);
    }
}
