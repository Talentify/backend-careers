<?php

namespace Recruitment\Modules\Jobs\Show\Rulesets;

use Recruitment\Modules\Jobs\Show\Responses\Response;
use Recruitment\Modules\Jobs\Show\Responses\Status;
use Recruitment\Modules\Jobs\Show\Rules\GetJobRule;

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
