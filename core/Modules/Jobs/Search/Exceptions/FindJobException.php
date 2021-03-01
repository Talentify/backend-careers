<?php

namespace Recruitment\Modules\Jobs\Search\Exceptions;

use Throwable;

class FindJobException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
