<?php

namespace Recruitment\Modules\Jobs\Show\Gateways;

use Recruitment\Modules\Jobs\Show\Entities\Job;
use Recruitment\Modules\Jobs\Show\Requests\Request;

interface GetJobGateway
{
    public function getJobById(Request $request): Job;
}
