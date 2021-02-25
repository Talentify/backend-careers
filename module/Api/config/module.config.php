<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Api;

use Api\Factory\LoginControllerFactory;
use Api\Factory\JobsControllerFactory;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'api-v1' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/v1',
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'login' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/login[/:action][/:id]',
                            'defaults' => [
                                'controller' => 'api-login',
                                'action' => 'index',
                                'isAuthorizationRequired' => false
                            ],
                            'constraints'	=> [
                                'id' 		=> '[0-9]',
                            ],
                        ],
                    ],
                    'jobs' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/jobs',
                            'defaults' => [
                                'controller' => 'api-jobs',
                                'action' => 'index',
                                'isAuthorizationRequired' => false
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'find-id' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/',
                                    'defaults' => [
                                        'controller' => 'api-jobs',
                                        'action' => 'index',
                                        'isAuthorizationRequired' => false
                                    ],
                                ],
                            ],
                            'register' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/register[/:id]',
                                    'defaults' => [
                                        'controller' => 'api-jobs',
                                        'action' => 'register',
                                        'isAuthorizationRequired' => true
                                    ],
                                    'constraints'	=> [
                                        'id' 		=> '[a-zA-Z0-9_-]+',
                                    ],
                                ],
                            ],
                        ]
                    ],
                ]
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            'api-login' => LoginControllerFactory::class,
            'api-jobs' => JobsControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
