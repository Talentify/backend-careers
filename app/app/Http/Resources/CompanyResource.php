<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id"            =>  $this->id,
            "name"          =>  $this->name,
            "size"          =>  $this->size,
            "description"   =>  $this->description,
        ];
    }
}
