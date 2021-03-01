<?php

namespace Recruitment\Modules\Recruiters\Login\Exceptions;

use Throwable;

class GetRecruiterCredentialsException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
