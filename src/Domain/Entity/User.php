<?php

namespace App\Domain\Entity;

use App\Core\Entity;

class User extends Entity
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    private $password;

    /**
     * User constructor.
     * @param int $id
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(int $id, string $name, string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
}