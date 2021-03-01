<?php

namespace Recruitment\Modules\Jobs\Create\Gateways;

use Recruitment\Modules\Jobs\Create\Requests\Request;

interface CreateJobGateway
{
    public function create(Request $request);
}
