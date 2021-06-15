<?php

namespace App\Auth\Exceptions;

use Exception;
use JsonSerializable;
use RuntimeException;

/**
 * Class PasswordTokenInvalidException
 * @package App\Auth\Exceptions
 */
class PasswordTokenInvalidException extends RuntimeException implements JsonSerializable
{
    protected $message = 'This password reset token is invalid.';
    protected $code = 412;

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
