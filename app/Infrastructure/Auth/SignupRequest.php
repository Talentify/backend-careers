<?php


namespace App\Infrastructure\Auth;


use Core\Requests\AbstractRequest;

final class SignupRequest extends AbstractRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed']
        ];
    }
}
