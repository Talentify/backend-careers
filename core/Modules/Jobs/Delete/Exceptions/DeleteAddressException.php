<?php

namespace Recruitment\Modules\Jobs\Delete\Exceptions;

use Throwable;

class DeleteAddressException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
