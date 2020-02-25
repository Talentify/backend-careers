<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class Users extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|min:10|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:1|max:20'
        ];
    }
}
