<?php

namespace App\Domain\Jobs\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:256'],
            'description' => ['required', 'string'],
            'status' => ['required', 'in:active,inactive'],
            'address' => ['nullable', 'array'],
            'address.street' => ['nullable', 'string'],
            'address.number' => ['nullable', 'string'],
            'address.complement' => ['nullable', 'string'],
            'address.neighborhood' => ['nullable', 'string'],
            'address.city' => ['nullable', 'string'],
            'address.state' => ['nullable', 'string'],
            'address.zip_code' => ['nullable', 'string'],
            'salary' => ['nullable', 'numeric']
        ];
    }
}
