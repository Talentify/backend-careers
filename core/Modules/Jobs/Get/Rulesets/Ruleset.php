<?php

namespace Recruitment\Modules\Jobs\Get\Rulesets;

use Recruitment\Modules\Jobs\Get\Responses\Response;
use Recruitment\Modules\Jobs\Get\Responses\Status;
use Recruitment\Modules\Jobs\Get\Rules\GetJobRule;

class Ruleset
{
    private $getJobRule;

    public function __construct(GetJobRule $getJobRule)
    {
        $this->getJobRule = $getJobRule;
    }

    public function apply(): Response
    {
        return new Response(
            new Status(
                200,
                'Ok'
            ),
            $this->getJobRule->apply()
        );
    }
}
