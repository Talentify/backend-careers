<?php

namespace Recruitment\Modules\Recruiters\Create\Rules;

use Recruitment\Modules\Recruiters\Create\Entities\Recruiter;
use Recruitment\Modules\Recruiters\Create\Gateways\CreateRecruiterGateway;
use Recruitment\Modules\Recruiters\Create\Requests\Request;

class CreateRecruiterRule
{
    private $createRecruiterGateway;
    private $request;

    public function __construct(CreateRecruiterGateway $createRecruiterGateway, Request $request)
    {
        $this->createRecruiterGateway = $createRecruiterGateway;
        $this->request = $request;
    }

    public function apply(): Recruiter
    {
        return $this->createRecruiterGateway->create($this->request);
    }
}
