<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded = ['name'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
