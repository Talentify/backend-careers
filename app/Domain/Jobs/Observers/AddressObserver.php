<?php

namespace Domain\Jobs\Observers;

use Domain\Jobs\Models\Address;
use Domain\Jobs\Models\Job;
use Illuminate\Support\Str;
use Spatie\ResponseCache\Facades\ResponseCache;

class AddressObserver
{
    /**
     * Handle the Address "creating" event.
     *
     * @param Address $address
     * @return void
     */
    public function creating(Address $address)
    {
        $address->id = Str::uuid();
    }

    /**
     * Handle the Address "created" event.
     *
     * @param Address $address
     * @return void
     */
    public function created(Address $address)
    {
        //
        ResponseCache::clear(['jobs']);
    }

    /**
     * Handle the Address "updated" event.
     *
     * @param Job $address
     * @return void
     */
    public function updated(Address $address)
    {
        //
        ResponseCache::clear(['jobs']);
    }

    /**
     * Handle the Address "deleted" event.
     *
     * @param Address $address
     * @return void
     */
    public function deleted(Address $address)
    {
        //
        ResponseCache::clear(['jobs']);
    }

    /**
     * Handle the Address "restored" event.
     *
     * @param Address $address
     * @return void
     */
    public function restored(Address $address)
    {
        //
        ResponseCache::clear(['jobs']);
    }

    /**
     * Handle the Address "force deleted" event.
     *
     * @param Address $address
     * @return void
     */
    public function forceDeleted(Address $address)
    {
        //
        ResponseCache::clear(['jobs']);
    }
}
