<?php

namespace Recruitment\Modules\Jobs\Show\Exceptions;

use Throwable;

class GetJobException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
