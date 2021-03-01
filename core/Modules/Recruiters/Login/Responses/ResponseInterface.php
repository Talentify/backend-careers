<?php

namespace Recruitment\Modules\Recruiters\Login\Responses;

interface ResponseInterface
{
    public function getStatus(): Status;

    public function getPresenter();
}
