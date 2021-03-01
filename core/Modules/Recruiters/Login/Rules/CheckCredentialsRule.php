<?php

namespace Recruitment\Modules\Recruiters\Login\Rules;

use Recruitment\Modules\Recruiters\Login\Gateways\GetRecruiterCredentialsGateway;
use Recruitment\Modules\Recruiters\Login\Requests\Request;

class CheckCredentialsRule
{
    private $getRecruiterCredentialsGateway;
    private $request;

    public function __construct(GetRecruiterCredentialsGateway $getRecruiterCredentialsGateway, Request $request)
    {
        $this->getRecruiterCredentialsGateway = $getRecruiterCredentialsGateway;
        $this->request = $request;
    }

    public function apply(): void
    {
        $this->getRecruiterCredentialsGateway->checkCredentials($this->request);
    }
}
