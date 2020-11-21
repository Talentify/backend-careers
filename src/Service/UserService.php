<?php
namespace App\Service;

use App\Entity\User;

class UserService extends AbstractEntityService
{
    /**
     * @return string
     */
    public function getEntityClass(): string
    {
        return User::class;
    }
}