<?php

namespace Recruitment\Modules\Recruiters\Create\Rulesets;

use Recruitment\Modules\Recruiters\Create\Responses\Response;
use Recruitment\Modules\Recruiters\Create\Responses\Status;
use Recruitment\Modules\Recruiters\Create\Rules\CreateRecruiterRule;

class Ruleset
{
    private $createRecruiterRule;

    public function __construct(CreateRecruiterRule $createRecruiterRule)
    {
        $this->createRecruiterRule = $createRecruiterRule;
    }

    public function apply(): Response
    {
        return new Response(
            new Status(
                201,
                'Created'
            ),
            $this->createRecruiterRule->apply()
        );
    }
}
