<?php

use App\Models\User;

return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],

    'guards' => [
        'api' => [
            'driver'   => 'token',
            'provider' => 'users',
            'hash'     => true
        ],
        'admin' => [
            'driver'   => 'token',
            'provider' => 'admins',
            'hash'     => true
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => User::class
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => Admin::class
        ]
    ]
];
