<?php

namespace App\User\Domain\Exceptions;

use Exception;
use Throwable;

/**
 * Class RecordExistException
 * @package App\User\Domain\Exceptions
 */
class RecordExistException extends Exception
{
    /**
     * RecordExistException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Record exist.", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
