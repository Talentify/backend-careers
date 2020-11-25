<?php

namespace App\Domain\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email'],
            'name' => ['required', 'string', 'max:200'],
            'password' => ['required', 'string', 'min:6', 'max:25'],
        ];
    }
}
