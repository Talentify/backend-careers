<?php

namespace Recruitment\Modules\Recruiters\Create\Exceptions;

use Throwable;

class CreateRecruiterException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
