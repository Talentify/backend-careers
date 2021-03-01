<?php

namespace Recruitment\Modules\Jobs\Update\Requests;

use Recruitment\Modules\Jobs\Update\Entities\Job;

class Request
{
    private $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    public function getJob(): Job
    {
        return $this->job;
    }
}
