<?php

namespace App\Validators;

class UserValidator
{
    const RULE_REGISTER = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required'
    ];

    const RULE_LOGIN = [
        'email' => 'required|email',
        'password' => 'required',
    ];
}
