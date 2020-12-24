<?php


namespace App\Infra\Request;


use Symfony\Component\Validator\Constraints as Assert;

class UserRequest
{
    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $name;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $email;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $username;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $password;
}
