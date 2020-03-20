<?php

declare(strict_types=1);

namespace App\Models\V1;

use App\Core\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use SoftDeletes;

    public const CREATED = 1;
    public const INTERVIEWING = 2;
    public const CONCLUDED = 3;
    public const CANCELLED = 4;

    protected $fillable = [
        'title',
        'description',
        'status',
        'workplace',
        'salary',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    protected $casts = [
        'status' => 'int',
        'salary' => 'float',
    ];
}
