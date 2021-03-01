<?php

namespace Recruitment\Modules\Recruiters\Create\Responses;

interface ResponseInterface
{
    public function getStatus(): Status;

    public function getPresenter();
}
