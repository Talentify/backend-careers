<?php

namespace Recruitment\Modules\Jobs\Search\Responses;

interface ResponseInterface
{
    public function getStatus(): Status;

    public function getPresenter();
}
