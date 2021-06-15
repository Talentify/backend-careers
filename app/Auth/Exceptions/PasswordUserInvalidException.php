<?php

namespace App\Auth\Exceptions;

use Exception;
use JsonSerializable;
use RuntimeException;

/**
 * Class PasswordUserInvalidException
 * @package App\Auth\Exceptions
 */
class PasswordUserInvalidException extends RuntimeException implements JsonSerializable
{
    protected $message = "We can't find a user with that e-mail address.";
    protected $code = 404;

    /**
     * InvalidCredentialsException constructor.
     *
     * @param  Exception  $previous
     * @param  string  $message
     * @param  int  $code
     */
    public function __construct(Exception $previous = null, $message = '', $code = 0)
    {
        if ('' === $message) {
            $message = $this->message;
        }

        if ($code === 0) {
            $code = $this->code;
        }

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function jsonSerialize()
    {
        return [
            "message" => $this->message,
            "code" => $this->code,
        ];
    }
}
