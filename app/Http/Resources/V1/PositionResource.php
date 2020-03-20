<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use App\Core\Http\Resources\Resource;
use Illuminate\Http\Request;

class PositionResource extends Resource
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
        return [
            'id'               => $this->id,
            'title'            => $this->title,
            'description'      => $this->description,
            'status'           => $this->status,
            'workplace'        => $this->workplace,
            'salary'           => $this->salary,
            'formatted_salary' => $this->when($this->salary, '$ '.number_format($this->salary ?? 0, 2, '.', ','), 'Not informed'),
            'created_at'       => $this->created_at,
        ];
    }
}
