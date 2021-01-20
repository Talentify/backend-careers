<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            =>  $this->id,
            'company'       =>  new CompanyResource($this->company),
            'workplace'     =>  $this->workplace,
            'title'         =>  $this->title,
            'description'   =>  $this->description,
            'salary'        =>  $this->salary,
            'status'        =>  $this->status,
        ];
    }
}
