<?php

namespace Recruitment\Modules\Jobs\Get\Gateways;

use Recruitment\Modules\Jobs\Get\Collections\JobCollection;

interface GetJobGateway
{
    public function getJobs(): JobCollection;
}
