<?php

namespace Recruitment\Modules\Jobs\Create\Exceptions;

use Throwable;

class CreateAddressException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
