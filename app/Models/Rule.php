<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rule extends Model
{
    use SoftDeletes, Filterable;

    protected $fillable = ['name', 'code'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role')->withTrashed();
    }
}
