<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'code'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function rules()
    {
        return $this->belongsToMany('App\Models\Rule')->withTrashed()->withTimestamps();
    }

}
