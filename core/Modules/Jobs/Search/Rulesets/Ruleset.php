<?php

namespace Recruitment\Modules\Jobs\Search\Rulesets;

use Recruitment\Modules\Jobs\Search\Responses\Response;
use Recruitment\Modules\Jobs\Search\Responses\Status;
use Recruitment\Modules\Jobs\Search\Rules\FindJobRule;

class Ruleset
{
    private $findJobRule;

    public function __construct(FindJobRule $findJobRule)
    {
        $this->findJobRule = $findJobRule;
    }

    public function apply(): Response
    {
        return new Response(
            new Status(
                200,
                'Ok'
            ),
            $this->findJobRule->apply()
        );
    }
}
