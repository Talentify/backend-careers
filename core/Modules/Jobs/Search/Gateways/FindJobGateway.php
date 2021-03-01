<?php

namespace Recruitment\Modules\Jobs\Search\Gateways;

use Recruitment\Modules\Jobs\Search\Collections\JobCollection;
use Recruitment\Modules\Jobs\Search\Requests\Request;

interface FindJobGateway
{
    public function findJob(Request $request): JobCollection;
}
