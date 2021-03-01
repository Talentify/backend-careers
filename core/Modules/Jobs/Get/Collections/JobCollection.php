<?php

namespace Recruitment\Modules\Jobs\Get\Collections;

use Recruitment\Modules\Jobs\Get\Entities\Job;

class JobCollection
{
    private $collector = [];

    public function add(Job $order): void
    {
        $this->collector[] = $order;
    }

    public function all(): array
    {
        return $this->collector;
    }
}
