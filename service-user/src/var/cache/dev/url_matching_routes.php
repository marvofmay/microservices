<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/test/number' => [[['_route' => 'app_test_number', '_controller' => 'App\\Controller\\TestController::number'], null, null, null, false, false, null]],
        '/api/categories' => [
            [['_route' => 'api.categories.index', '_controller' => 'App\\Category\\Presentation\\API\\CategoryController::index'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'api.categories.create', '_controller' => 'App\\Category\\Presentation\\API\\CategoryController::create'], null, ['POST' => 0], null, true, false, null],
        ],
        '/api/users' => [
            [['_route' => 'api.users.index', '_controller' => 'App\\User\\Presentation\\API\\UserController::index'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'api.users.store', '_controller' => 'App\\User\\Presentation\\API\\UserController::store'], null, ['POST' => 0], null, false, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/(?'
                    .'|categories/(?'
                        .'|(\\d+)(*:69)'
                        .'|([^/]++)(*:84)'
                        .'|(\\d+)(*:96)'
                    .')'
                    .'|users/(?'
                        .'|([^/]++)(?'
                            .'|(*:124)'
                        .')'
                        .'|register(*:141)'
                        .'|([^/]++)(*:157)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        69 => [[['_route' => 'api.categories.show', '_controller' => 'App\\Category\\Presentation\\API\\CategoryController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        84 => [[['_route' => 'api.categories.update', '_controller' => 'App\\Category\\Presentation\\API\\CategoryController::update'], ['id'], ['PUT' => 0], null, false, true, null]],
        96 => [[['_route' => 'api.categories.delete', '_controller' => 'App\\Category\\Presentation\\API\\CategoryController::destroy'], ['id'], ['DELETE' => 0], null, false, true, null]],
        124 => [
            [['_route' => 'api.users.show', '_controller' => 'App\\User\\Presentation\\API\\UserController::show'], ['uuid'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api.users.update', '_controller' => 'App\\User\\Presentation\\API\\UserController::update'], ['uuid'], ['PUT' => 0], null, false, true, null],
        ],
        141 => [[['_route' => 'api.users.register', '_controller' => 'App\\User\\Presentation\\API\\UserController::register'], [], ['POST' => 0], null, false, false, null]],
        157 => [
            [['_route' => 'api.users.destroy', '_controller' => 'App\\User\\Presentation\\API\\UserController::destroy'], ['uuid'], ['DELETE' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
