<?php

namespace App\Jobs\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Companies\Models\Company;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Job
 * @package App\Jobs\Models
 */
class Job extends Eloquent
{
    use SoftDeletes;

    /**
     * @return HasOne
     */
    public function companies()
    {
        return $this->hasOne(Company::class);
    }
}
