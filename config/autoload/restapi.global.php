<?php

return [
    'ApiRequest' => [
        'responseFormat' => [
            'statusKey' => 'success',
            'statusOkText' => true,
            'statusNokText' => false,
            'resultKey' => 'data',
            'messageKey' => 'error',
            'defaultMessageText' => 'Empty response!',
            'errorKey' => 'error',
            'defaultErrorText' => 'Unknown request!',
            'authenticationRequireText' => 'Authentication Required.',
            'pageNotFoundKey' => 'Request Not Found.',
        ],
        'jwtAuth' => [
            'cypherKey' => 'ygXKxjqaCDPqbda973aNYkvzgnabKkg9cQJkYJmcXLsYPcKM6KbFUw52v5NQ2UAPAUZauWc3yfSchdAYNCvjJaVPRzwu6G8gtJ4Lw6rEW8u6bTFA7MJtMv7eEdymLxe4',
            'tokenAlgorithm' => 'HS256'
        ],
    ]
];