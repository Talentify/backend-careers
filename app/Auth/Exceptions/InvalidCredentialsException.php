<?php

namespace App\Auth\Exceptions;

use Exception;
use JsonSerializable;
use RuntimeException;

/**
 * Class InvalidCredentialsException
 * @package App\Auth\Exceptions
 */
class InvalidCredentialsException extends RuntimeException implements JsonSerializable
{
    protected $message = 'Invalid credentials';
    protected $code = 401;

    /**
     * InvalidCredentialsException constructor.
     *
     * @param  Exception  $previous
     * @param  string  $message
     * @param  int  $code
     */
    public function __construct(Exception $previous = null, $message = '', $code = 0)
    {
        $message = sprintf('%s %s', $this->message, $message);
        if ('' === $message) {
            $message = $this->message;
        }

        if ($code === 0) {
            $code = $this->code;
        }

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            "message" => $this->message,
            "code" => $this->code,
        ];
    }
}
