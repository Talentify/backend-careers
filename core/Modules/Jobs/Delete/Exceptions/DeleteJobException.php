<?php

namespace Recruitment\Modules\Jobs\Delete\Exceptions;

use Throwable;

class DeleteJobException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
