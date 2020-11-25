<?php

namespace Domain\Users;

use Domain\DomainModel;

class Role extends DomainModel
{
    protected $fillable = [
        'id',
        'name',
        'slug',
    ];
}
