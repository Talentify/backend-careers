<?php

namespace Recruitment\Modules\Recruiters\Create\Gateways;

use Recruitment\Modules\Recruiters\Create\Requests\Request;

interface CreateRecruiterGateway
{
    public function create(Request $request);
}
