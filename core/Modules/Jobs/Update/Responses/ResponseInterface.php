<?php

namespace Recruitment\Modules\Jobs\Update\Responses;

interface ResponseInterface
{
    public function getStatus(): Status;

    public function getPresenter();
}
