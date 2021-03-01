<?php

namespace Recruitment\Modules\Jobs\Delete\Gateways;

use Recruitment\Modules\Jobs\Delete\Requests\Request;

interface DeleteJobGateway
{
    public function delete(Request $request): void;
}
