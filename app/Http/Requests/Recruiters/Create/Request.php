<?php

namespace App\Http\Requests\Recruiters\Create;

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
            'name' => 'required|string',
            'cpf' => 'required|string|size:11',
            'companyId' => 'required|integer',
            'email' => 'required|email',
            'password' => 'required|string'
        ];
    }
}
