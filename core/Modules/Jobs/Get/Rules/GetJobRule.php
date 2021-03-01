<?php

namespace Recruitment\Modules\Jobs\Get\Rules;

use Recruitment\Modules\Jobs\Get\Collections\JobCollection;
use Recruitment\Modules\Jobs\Get\Gateways\GetJobGateway;

class GetJobRule
{
    private $getJobGateway;

    public function __construct(GetJobGateway $getJobGateway)
    {
        $this->getJobGateway = $getJobGateway;
    }

    public function apply(): JobCollection
    {
        return $this->getJobGateway->getJobs();
    }
}
