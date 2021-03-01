<?php

namespace Recruitment\Modules\Recruiters\Create\Presenters;

use Recruitment\Modules\Recruiters\Create\Entities\Recruiter;

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
            'name' => $this->recruiter->getName(),
            'cpf' => $this->recruiter->getCpf(),
            'email' => $this->recruiter->getEmail(),
            'companyId' => $this->recruiter->getCompanyId()
        ];
        return $this;
    }

    public function toArray(): array
    {
        return $this->presenter;
    }
}
