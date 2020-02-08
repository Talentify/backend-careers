<?php

declare(strict_types=1);

namespace App\Models\V1;

use App\Core\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Example extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'deleted_at',
    ];
}
