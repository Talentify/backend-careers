<?php

namespace Recruitment\Modules\Jobs\Create\Rulesets;

use Recruitment\Modules\Jobs\Create\Responses\Response;
use Recruitment\Modules\Jobs\Create\Responses\Status;
use Recruitment\Modules\Jobs\Create\Rules\CreateJobRule;

class Ruleset
{
    private $createJobRule;

    public function __construct(CreateJobRule $createJobRule)
    {
        $this->createJobRule = $createJobRule;
    }

    public function apply(): Response
    {
        return new Response(
            new Status(
                201,
                'Created'
            ),
            $this->createJobRule->apply()
        );
    }
}
