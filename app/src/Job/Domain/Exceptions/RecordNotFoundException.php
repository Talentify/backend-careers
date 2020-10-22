<?php

namespace App\Job\Domain\Exceptions;

use Exception;
use Throwable;

/**
 * Class RecordNotFoundException
 * @package App\Job\Domain\Exceptions
 */
class RecordNotFoundException extends Exception
{
    /**
     * RecordNotFoundException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Record not found.", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
