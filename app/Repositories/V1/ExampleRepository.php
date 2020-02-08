<?php

declare(strict_types=1);

namespace App\Repositories\V1;

use App\Core\Repositories\Repository;
use App\Models\V1\Example;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ExampleRepository
 *
 * @package App\Repositories\V1
 */
class ExampleRepository extends Repository
{
    /**
     * @return string
     */
    protected function model(): string
    {
        return Example::class;
    }

    /**
     * @param $filter
     * @param $value
     *
     * @return Builder
     */
    protected function filters($filter, $value): Builder
    {
        switch ($filter) {
            case 'name':
            case 'email':
                return $this->query->where($filter, 'LIKE', '%'.$value.'%');
                break;
            case 'id':
            default:
                return $this->query->where($filter, $value);
        }
    }
}
