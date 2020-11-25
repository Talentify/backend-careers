<?php

namespace Domain\Jobs;

class Status
{
    const ACTIVE = 'active';

    const INACTIVE = 'inactive';

    static array $all = [self::ACTIVE, self::INACTIVE];
}
