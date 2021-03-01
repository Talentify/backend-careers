<?php

namespace Recruitment\Modules\Recruiters\Login\Generators;

class TokenGenerator
{
    public function generate(string $email): string
    {
        return md5($email . date('h-i-s Y-m-d'));
    }
}
