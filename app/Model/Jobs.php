<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jobs extends Model
{
    use SoftDeletes;

    protected $table = 'jobs';
    protected $guarded = ['id'];
}
