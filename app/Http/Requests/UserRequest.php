<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if ($this->method() == "PUT") {
            return [
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:1255',
                'email' => 'required|email|max:255|unique:users,email,', $this->userId,
                'password' => 'string|confirmed|min:6|max:255',
                'role_id' => 'integer|exists:roles,id',
            ];
        }
        return [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:1255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|confirmed|min:6|max:255',
            'role_id' => 'integer|exists:roles,id',
        ];
    }
}
