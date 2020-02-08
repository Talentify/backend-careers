<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use App\Core\Http\Resources\Resource;
use Illuminate\Http\Request;

class ExampleResource extends Resource
{
    /**
     * Transform the resource into an array.
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
