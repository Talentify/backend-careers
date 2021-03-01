<?php

namespace Recruitment\Modules\Jobs\Delete\Rulesets;

use Recruitment\Modules\Jobs\Delete\Responses\Response;
use Recruitment\Modules\Jobs\Delete\Responses\Status;
use Recruitment\Modules\Jobs\Delete\Rules\DeleteJobRule;

class Ruleset
{
    private $deleteJobRule;

    public function __construct(DeleteJobRule $deleteJobRule)
    {
        $this->deleteJobRule = $deleteJobRule;
    }

    public function apply(): Response
    {
        $this->deleteJobRule->apply();
        return new Response(
            new Status(
                200,
                'Ok'
            ),
            'Job successfully deleted.'
        );
    }
}
