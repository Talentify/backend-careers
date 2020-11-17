<?php

namespace Domain\Jobs\Observers;

use Domain\Jobs\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\ResponseCache\Facades\ResponseCache;

class JobObserver
{
    /**
     * Handle the Job "creating" event.
     *
     * @param Job $job
     * @return void
     */
    public function creating(Job $job)
    {
        $job->id = Str::uuid();
        $job->status = $job->status ?? Job::STATUS_OPEN;
        $job->user_id = Auth::id();
    }

    /**
     * Handle the Job "created" event.
     *
     * @param Job $job
     * @return void
     */
    public function created(Job $job)
    {
        //
        ResponseCache::clear(['jobs']);
    }

    /**
     * Handle the Job "updated" event.
     *
     * @param Job $job
     * @return void
     */
    public function updated(Job $job)
    {
        //
        ResponseCache::clear(['jobs']);
    }

    /**
     * Handle the Job "deleted" event.
     *
     * @param Job $job
     * @return void
     */
    public function deleted(Job $job)
    {
        //
        ResponseCache::clear(['jobs']);
    }

    /**
     * Handle the Job "restored" event.
     *
     * @param Job $job
     * @return void
     */
    public function restored(Job $job)
    {
        //
        ResponseCache::clear(['jobs']);
    }

    /**
     * Handle the Job "force deleted" event.
     *
     * @param Job $job
     * @return void
     */
    public function forceDeleted(Job $job)
    {
        //
        ResponseCache::clear(['jobs']);
    }
}
