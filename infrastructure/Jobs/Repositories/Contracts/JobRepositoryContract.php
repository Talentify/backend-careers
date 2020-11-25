<?php

namespace Infrastructure\Jobs\Repositories\Contracts;

use Illuminate\Support\Collection;

interface JobRepositoryContract
{
    public function findActiveJobs(): ?Collection;
}
