<?php

namespace Recruitment\Modules\Jobs\Update\Gateways;

use Recruitment\Modules\Jobs\Update\Entities\Job;
use Recruitment\Modules\Jobs\Update\Requests\Request;

interface UpdateJobGateway
{
    public function update(Request $request): Job;
}
