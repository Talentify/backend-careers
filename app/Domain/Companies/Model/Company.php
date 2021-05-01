<?php

namespace App\Domain\Companies\Model;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $connection= 'pgsql';

    protected $table = 'companies';
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'status',
        'created_at',
        'updated_at'
    ];

}