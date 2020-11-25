<?php

namespace App\Domain\Jobs\Services;

use Domain\Jobs\Job;
use Domain\Shared\Address;
use Illuminate\Support\Facades\DB;
use Infrastructure\Jobs\Repositories\Facades\JobRepository;

class CreateJobService
{
    public function __invoke(array $data)
    {
        $job = new Job($data);

        $job->address = Address::make($data);

        try {
            DB::transaction(function () use ($job) {
                JobRepository::persist($job);
            });
        } catch (\Exception $e) {
            throw $e;
        }

        return $job;
    }
}
