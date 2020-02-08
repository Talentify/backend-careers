<?php

declare(strict_types=1);

namespace App\Http\Requests\V1;

use App\Core\Http\Requests\GetAllRequest;

class ExampleGetAll extends GetAllRequest
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
        return [];
    }

    function allowedFilters(): array
    {
        return [];
    }
}
