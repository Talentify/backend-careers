<?php

namespace Recruitment\Modules\Jobs\Update\Resolver;

use Recruitment\Modules\Jobs\Update\Requests\Request;

class CheckOwnerJobResolver
{
    public function resolve(int $recruiterId, Request $request): bool
    {
        if ($recruiterId != $request->getJob()->getRecruiterId()) {
            return false;
        }

        return true;
    }
}
