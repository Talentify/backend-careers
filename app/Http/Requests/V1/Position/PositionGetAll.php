<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\Position;

use App\Core\Http\Requests\GetAllRequest;

class PositionGetAll extends GetAllRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    function allowedOrderBy(): array
    {
        return [
            'title',
            'description',
            'status',
            'workplace',
            'salary',
        ];
    }

    function allowedFilters(): array
    {
        return [
            'title',
            'description',
            'status',
            'workplace',
            'salary',
        ];
    }
}
