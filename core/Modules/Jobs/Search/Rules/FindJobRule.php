<?php

namespace Recruitment\Modules\Jobs\Search\Rules;

use Recruitment\Modules\Jobs\Search\Collections\JobCollection;
use Recruitment\Modules\Jobs\Search\Gateways\FindJobGateway;
use Recruitment\Modules\Jobs\Search\Requests\Request;

class FindJobRule
{
    private $findJobGateway;
    private $request;

    public function __construct(FindJobGateway $findJobGateway, Request $request)
    {
        $this->findJobGateway = $findJobGateway;
        $this->request = $request;
    }

    public function apply(): JobCollection
    {
        return $this->findJobGateway->findJob($this->request);
    }
}
