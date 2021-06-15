<?php

namespace App\Companies\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Jobs\Models\Job;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Company
 * @package App\Companies
 */
class Company extends Eloquent
{
    use SoftDeletes;

    /**
     * @return HasMany
     */
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
