<?php

return [
    'guards' => [
        'admin' => [
            'driver'   => 'admin',
            'provider' => 'admins',
        ],
        'user'   => [
            'driver'   => 'user',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'admins' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Admin::class,
        ],
        'users'   => [
            'driver' => 'eloquent',
            'model'  => App\Models\User::class,
        ],
    ],
];
