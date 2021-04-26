<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UuidTrait;

class Company extends Model
{
    use HasFactory;
    use UuidTrait;

    protected $table = 'companies';

    protected $primaryKey = 'id';

    protected $keyType  = 'string';

    protected $fillable = [
        'name'
    ];

    public $incrementing = false;

    public $timestamps = true;

}
