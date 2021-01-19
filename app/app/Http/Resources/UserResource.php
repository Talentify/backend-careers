<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id"        =>  $this->id,
            "name"      =>  $this->full_name,
            "email"     =>  $this->email,
            "status"    =>  $this->status,
            "role"      =>  $this->role,
        ];
    }
}
