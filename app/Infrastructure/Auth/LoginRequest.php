<?php


namespace App\Infrastructure\Auth;


use Core\Requests\AbstractRequest;

class LoginRequest extends AbstractRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required'],
            'password' => ['required']
        ];
    }
}
