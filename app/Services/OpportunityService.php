<?php

namespace App\Services;

use App\Models\Opportunity;
use Illuminate\Database\Eloquent\Collection;

class OpportunityService
{
    /**
     * Return all Opportunities
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return Opportunity::all();
    }

    /**
     * Create a new Opportunity
     *
     * @param  array  $attributes
     *
     * @return Opportunity
     */
    public function create(array $attributes): Opportunity
    {
        return Opportunity::create($attributes);
    }
}
