<?php

namespace Recruitment\Modules\Jobs\Search\Collections;

use Recruitment\Modules\Jobs\Search\Entities\Job;

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
