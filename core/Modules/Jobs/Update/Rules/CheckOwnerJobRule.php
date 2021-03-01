<?php

namespace Recruitment\Modules\Jobs\Update\Rules;

use Recruitment\Modules\Jobs\Update\Exceptions\NotEditableJobException;
use Recruitment\Modules\Jobs\Update\Gateways\GetJobGateway;
use Recruitment\Modules\Jobs\Update\Requests\Request;
use Recruitment\Modules\Jobs\Update\Resolver\CheckOwnerJobResolver;

class CheckOwnerJobRule
{
    private $getOrderGateway;
    private $request;

    public function __construct(GetJobGateway $getOrderGateway, Request $request)
    {
        $this->getOrderGateway = $getOrderGateway;
        $this->request = $request;
    }

    public function apply()
    {
        $recruiterId = $this->getOrderGateway->getRecruiterIdJobById($this->request);
        $isOwner = (new CheckOwnerJobResolver())->resolve($recruiterId, $this->request);

        if (!$isOwner) {
            throw new NotEditableJobException(
                'This job cannot be edited because it belongs to another recruiter',
                400
            );
        }
    }
}
