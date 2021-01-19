<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id"            =>  $this->id,
            "company"       =>  $this->company_id,
            "workplace"     =>  $this->workplace_id,
            "title"         =>  $this->title,
            "description"   =>  $this->description,
        ];
    }
}
