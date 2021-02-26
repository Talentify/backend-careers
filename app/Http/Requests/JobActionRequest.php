<?php

namespace App\Http\Requests;

use App\Core\Laravel\FormRequest;

class JobActionRequest extends FormRequest
{

    public function rules()
    {
        return [
            'id'=> ['required', 'numeric', 'gt:0'],
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'id é obrigatório',
            'id.numeric' => 'id deve ser um numero',
            'id.gt' => 'id deve ser um numero maior que 0',
        ];
    }

    /**
     * Add parameters to be validated
     *
     * @return array
     */
    public function all($keys = null)
    {
        return [
            'id' => request('id')
        ];
    }
}
