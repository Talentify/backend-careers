<?php

namespace App\Domain\Exception;

class FormValidationException extends \Exception
{
    public function __construct($message = 'Form error')
    {
        parent::__construct($message, 500);
    }
}