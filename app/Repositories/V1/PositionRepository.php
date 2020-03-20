<?php

declare(strict_types=1);

namespace App\Repositories\V1;

use App\Core\Repositories\Repository;
use App\Models\V1\Position;

/**
 * Class PositionRepository
 *
 * @package App\Repositories\V1
 */
class PositionRepository extends Repository
{
    /**
     * @return string
     */
    protected function model(): string
    {
        return Position::class;
    }
}
