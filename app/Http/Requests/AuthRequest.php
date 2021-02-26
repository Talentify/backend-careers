<?php

namespace App\Http\Requests;

use App\Core\Laravel\FormRequest;

class AuthRequest extends FormRequest
{

    public function rules()
    {
        return [
            'email'     => ['required', 'email'],
            'password'  => ['required'],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute é obrigatório',
            'email.email' => 'digite um email válido',
        ];
    }
}
