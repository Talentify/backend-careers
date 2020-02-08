<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use App\Core\Http\Resources\ResourceCollection;
use Illuminate\Http\Request;

class ExampleResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
