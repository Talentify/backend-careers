<?php

namespace App\Domain\Enum\Job;

class StatusEnum
{
    public const OPEN = 1;
    public const IN_PROGRESS = 2;
    public const CLOSED = 3;

    public const ALL = [
        self::OPEN => 'Open',
        self::IN_PROGRESS => 'In Progress',
        self::CLOSED => 'Closed',
    ];

    public static function translate(int $value):? string
    {
        return self::ALL[$value] ?? null;
    }
}