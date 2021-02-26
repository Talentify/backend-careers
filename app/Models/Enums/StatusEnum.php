<?php

namespace App\Models\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self OPEN()
 * @method static self STANDBY()
 * @method static self FINISHED()
 * @method static self CLOSED()
 */
final class StatusEnum extends Enum {}
