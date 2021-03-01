<?php

namespace Recruitment\Modules\Jobs\Update\Rules;

use Recruitment\Modules\Jobs\Update\Entities\Job;
use Recruitment\Modules\Jobs\Update\Gateways\UpdateJobGateway;
use Recruitment\Modules\Jobs\Update\Requests\Request;

class UpdateJobRule
{
    private $updateJobGateway;
    private $request;

    public function __construct(UpdateJobGateway $updateJobGateway, Request $request)
    {
        $this->updateJobGateway = $updateJobGateway;
        $this->request = $request;
    }

    public function apply(): Job
    {
        return $this->updateJobGateway->update($this->request);
    }
}
