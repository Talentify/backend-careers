<?php

namespace Recruitment\Modules\Recruiters\Login\Rulesets;

use Recruitment\Modules\Recruiters\Login\Responses\Response;
use Recruitment\Modules\Recruiters\Login\Responses\Status;
use Recruitment\Modules\Recruiters\Login\Rules\CheckCredentialsRule;
use Recruitment\Modules\Recruiters\Login\Rules\CreateLoginTokenRule;

class Ruleset
{
    private $checkCredentialsRule;
    private $createLoginTokenRule;

    public function __construct(CheckCredentialsRule $checkCredentialsRule, CreateLoginTokenRule $createLoginTokenRule)
    {
        $this->checkCredentialsRule = $checkCredentialsRule;
        $this->createLoginTokenRule = $createLoginTokenRule;
    }

    public function apply(): Response
    {
        $this->checkCredentialsRule->apply();
        return new Response(
            new Status(
                200,
                'Ok'
            ),
            $this->createLoginTokenRule->apply()
        );
    }
}
