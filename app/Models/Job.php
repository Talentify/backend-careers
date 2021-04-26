<?php

namespace App\Models;

use App\Http\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    use UuidTrait;

    protected $table = 'jobs';

    protected $primaryKey = 'id';

    protected $keyType  = 'string';

    protected $fillable = [
        'title',
        'description',
        'status',
        'address',
        'salary',
        'recruiter_id',
        'company_id',
    ];

    public $incrementing = false;

    public $timestamps = true;

    const JOB_STATUS_OPEN = 'open';
    const JOB_STATUS_CLOSE = 'close';

    public function company()
    {
        $this->belongsTo(Company::class);
    }

}
