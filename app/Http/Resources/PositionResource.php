<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class PositionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id ,
            'title' => $this->title ,
            'description' => $this->description ,
            'address' => $this->address ,
            'salary' => $this->salary ,
            'status' => $this->status ,
            'company_id' => $this->company->id,
            'company_name' => $this->company->name,
            'recruiter_id' => $this->recruiter->id,
            'recruiter_name' => $this->recruiter->name,
        ];
    }
}
