<?php

namespace Recruitment\Modules\Jobs\Get\Responses;

interface ResponseInterface
{
    public function getStatus(): Status;

    public function getPresenter();
}
