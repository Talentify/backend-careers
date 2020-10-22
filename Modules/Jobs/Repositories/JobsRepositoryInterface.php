<?php


namespace Modules\Jobs\Repositories;

use Illuminate\Support\MessageBag;

interface JobsRepositoryInterface
{
    public function listOpenJobs();

    public function createNewJob(array $data);

    public function getErrors(): MessageBag;
}
