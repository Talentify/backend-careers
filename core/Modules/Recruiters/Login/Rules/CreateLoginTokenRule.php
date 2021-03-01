<?php

namespace Recruitment\Modules\Recruiters\Login\Rules;

use Recruitment\Modules\Recruiters\Login\Entities\Recruiter;
use Recruitment\Modules\Recruiters\Login\Gateways\UpdateRecruiterGateway;
use Recruitment\Modules\Recruiters\Login\Generators\TokenGenerator;
use Recruitment\Modules\Recruiters\Login\Requests\Request;

class CreateLoginTokenRule
{
    private $updateRecruiterGateway;
    private $request;

    public function __construct(UpdateRecruiterGateway $updateRecruiterGateway, Request $request)
    {
        $this->updateRecruiterGateway = $updateRecruiterGateway;
        $this->request = $request;
    }

    public function apply(): Recruiter
    {
        $token = (new TokenGenerator())->generate($this->request->getEmail());
        $this->updateRecruiterGateway->updateAccessToken($token,$this->request->getEmail());

        return new Recruiter(
            $this->request->getEmail(),
            $token
        );
    }
}
