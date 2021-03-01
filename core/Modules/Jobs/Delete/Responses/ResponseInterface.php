<?php

namespace Recruitment\Modules\Jobs\Delete\Responses;

interface ResponseInterface
{
    public function getStatus(): Status;

    public function getPresenter();
}
