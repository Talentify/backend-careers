<?php

namespace Recruitment\Modules\Jobs\Update\Gateways;

use Recruitment\Modules\Jobs\Update\Requests\Request;

interface GetJobGateway
{
    public function getRecruiterIdJobById(Request $request): ?int;
}
