<?php

namespace App\Auth\Exceptions;

use Exception;
use JsonSerializable;
use RuntimeException;

/**
 * Class UserNotFoundOnThisClientException
 * @package App\Auth\Exceptions
 */
class UserNotFoundOnThisClientException extends RuntimeException implements JsonSerializable
{
    protected $message = 'User not found on this client';
    protected $code = 404;

    /**
     * @param  string  $message
     * @param  int  $code
     * @param  Exception  $previous
     */
    public function __construct($message = '', $code = 0, Exception $previous = null)
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
