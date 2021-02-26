<?php

namespace App\Repositores\Elloquent;

use App\Models\User;
use App\Repositores\Contracts\UserRepositoryInterface;

final class UserRepository implements UserRepositoryInterface {

    protected User $entity;

    public function __construct(User $entity){
        $this->entity = $entity;
    }

}
