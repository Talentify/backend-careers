<?php

namespace Recruitment\Modules\Jobs\Update\Exceptions;

use Throwable;

class JobNotFoundException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
