<?php

namespace Recruitment\Modules\Recruiters\Login\Gateways;

interface UpdateRecruiterGateway
{
    public function updateAccessToken(string $token, string $email);
}
