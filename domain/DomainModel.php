<?php

namespace Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class DomainModel extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    public function __construct(array $attributes = [])
    {
        if (!array_key_exists('id', $attributes)) {
            $attributes['id'] = Uuid::uuid4()->toString();
        }

        parent::__construct($attributes);
    }
}
