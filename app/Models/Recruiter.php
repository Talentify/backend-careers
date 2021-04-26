<?php

namespace App\Models;

use App\Http\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruiter extends Model
{
    use HasFactory;
    use UuidTrait;

    protected $table = 'recruiters';

    protected $primaryKey = 'id';

    protected $keyType  = 'string';

    protected $fillable = [
        'name',
        'company_id',
        'login',
        'password',
    ];

    public $incrementing = false;

    public $timestamps = true;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
