<?php

namespace Recruitment\Modules\Recruiters\Login\Presenters;

use Recruitment\Modules\Recruiters\Login\Entities\Recruiter;

class RecruiterPresenter
{
    private $recruiter;
    private $presenter;

    public function __construct(Recruiter $recruiter)
    {
        $this->recruiter = $recruiter;
    }

    public function present(): self
    {
        $this->presenter = [
            'email' => $this->recruiter->getEmail(),
            'token' => $this->recruiter->getToken()
        ];
        return $this;
    }

    public function toArray(): array
    {
        return $this->presenter;
    }
}
