<?php

namespace Recruitment\Modules\Recruiters\Login\Gateways;

use Recruitment\Modules\Recruiters\Login\Requests\Request;

interface GetRecruiterCredentialsGateway
{
    public function checkCredentials(Request $request): void;
}
