<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/admin/jobs/new' => [[['_route' => 'job_new', '_controller' => 'App\\Infrastructure\\Action\\Admin\\Jobs\\FormAction'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/jobs' => [[['_route' => 'jobs_list', '_controller' => 'App\\Infrastructure\\Action\\Admin\\Jobs\\ListAction'], null, ['GET' => 0], null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Infrastructure\\Action\\Admin\\LogoutAction::logout'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'home', '_controller' => 'App\\Infrastructure\\Action\\HomeAction'], null, ['GET' => 0], null, false, false, null]],
        '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Infrastructure\\Action\\LoginAction'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/admin/jobs/(?'
                    .'|([^/]++)/(?'
                        .'|confirme/delete(*:84)'
                        .'|delete(*:97)'
                        .'|edit(*:108)'
                    .')'
                    .'|page(?:/([^/]++))?(*:135)'
                    .'|status(?'
                        .'|(?:/([^/]++))?(*:166)'
                        .'|/([^/]++)/page(?:/([^/]++))?(*:202)'
                    .')'
                .')'
                .'|/page(?:/([^/]++))?(*:231)'
            .')/?$}sD',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        84 => [[['_route' => 'job_confirme_delete', '_controller' => 'App\\Infrastructure\\Action\\Admin\\Jobs\\ConfirmeDeleteAction'], ['job'], ['GET' => 0], null, false, false, null]],
        97 => [[['_route' => 'job_delete', '_controller' => 'App\\Infrastructure\\Action\\Admin\\Jobs\\DeleteAction'], ['job'], ['GET' => 0], null, false, false, null]],
        108 => [[['_route' => 'job_edit', 'job' => null, '_controller' => 'App\\Infrastructure\\Action\\Admin\\Jobs\\FormAction'], ['job'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        135 => [[['_route' => 'jobs_list_page', 'page' => null, '_controller' => 'App\\Infrastructure\\Action\\Admin\\Jobs\\ListAction'], ['page'], ['GET' => 0], null, false, true, null]],
        166 => [[['_route' => 'jobs_list_status', 'status' => null, '_controller' => 'App\\Infrastructure\\Action\\Admin\\Jobs\\ListAction'], ['status'], ['GET' => 0], null, false, true, null]],
        202 => [[['_route' => 'jobs_list_status_page', 'status' => null, 'page' => null, '_controller' => 'App\\Infrastructure\\Action\\Admin\\Jobs\\ListAction'], ['status', 'page'], ['GET' => 0], null, false, true, null]],
        231 => [
            [['_route' => 'home_page', 'page' => null, '_controller' => 'App\\Infrastructure\\Action\\HomeAction'], ['page'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
