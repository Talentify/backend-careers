<?php

namespace Recruitment\Modules\Jobs\Update\Rulesets;

use Recruitment\Modules\Jobs\Update\Responses\Response;
use Recruitment\Modules\Jobs\Update\Responses\Status;
use Recruitment\Modules\Jobs\Update\Rules\CheckOwnerJobRule;
use Recruitment\Modules\Jobs\Update\Rules\UpdateJobRule;

class Ruleset
{
    private $updateJobRule;
    private $checkOwnerJobRule;

    public function __construct(UpdateJobRule $updateJobRule, CheckOwnerJobRule $checkOwnerJobRule)
    {
        $this->updateJobRule = $updateJobRule;
        $this->checkOwnerJobRule = $checkOwnerJobRule;
    }

    public function apply(): Response
    {
        $this->checkOwnerJobRule->apply();
        return new Response(
            new Status(
                200,
                'Ok'
            ),
            $this->updateJobRule->apply()
        );
    }
}
