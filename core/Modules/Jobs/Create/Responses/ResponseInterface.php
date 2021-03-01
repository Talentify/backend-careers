<?php

namespace Recruitment\Modules\Jobs\Create\Responses;

interface ResponseInterface
{
    public function getStatus(): Status;

    public function getPresenter();
}
