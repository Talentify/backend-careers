<?php

namespace App\Http\Requests\Jobs\Create;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tittle' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string|in:ACTIVE,INACTIVE',
            'salary' => 'required|numeric',
            'keywords' => 'required|string',
            'recruiterId' => 'required|integer',
            'address.address' => 'required|string',
            'address.number' => 'required|integer',
            'address.city' => 'required|string',
            'address.state' => 'required|string',
            'address.country' => 'required|string',
            'address.complement' => 'required|string'
        ];
    }
}
