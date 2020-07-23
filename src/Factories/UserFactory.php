<?php

namespace App\Factories;

use App\Domain\Entity\User;

class UserFactory
{
    /**
     * @param $id
     * @param $name
     * @param $email
     * @param $password
     * @return User
     */
    public static function make($id, $name, $email, $password)
    {
        return new User($id, $name, $email, $password);
    }
}