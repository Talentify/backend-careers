<?php

namespace App\User\Domain\Exceptions;

use Exception;
use Throwable;

/**
 * Class AccessDeniedException
 * @package App\User\Domain\Exceptions
 */
class AccessDeniedException extends Exception
{
    /**
     * AccessDeniedException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Access denied.", $code = 403, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
