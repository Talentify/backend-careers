<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\Auth;

use App\Core\Http\Requests\Request;

/**
 * Class Login
 *
 * @package App\Http\Requests\V1\Auth
 */
class Login extends Request
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
            'email'       => 'required|string|email',
            'password'    => 'required|string',
            'remember_me' => 'boolean',
        ];
    }
}
