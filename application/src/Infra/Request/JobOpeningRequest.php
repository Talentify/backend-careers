<?php


namespace App\Infra\Request;


use Symfony\Component\Validator\Constraints as Assert;

class JobOpeningRequest
{
    /**
     * @Assert\NotBlank()
     */
    public $title;

    /**
     * @Assert\NotBlank()
     */
    public $description;

    /**
     * @Assert\NotBlank()
     */
    public $status;

    public $workplace;

    public $salary;
}
