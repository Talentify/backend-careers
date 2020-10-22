<?php

namespace App\User\Domain\Exceptions;

use Exception;
use Throwable;

/**
 * Class EnvNotFoundException
 * @package App\User\Domain\Exceptions
 */
class EnvNotFoundException extends Exception
{
    /**
     * EnvNotFoundException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Env not found.", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
