<?php

namespace Recruitment\Modules\Jobs\Show\Responses;

interface ResponseInterface
{
    public function getStatus(): Status;

    public function getPresenter();
}
