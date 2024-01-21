<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/test/number' => [[['_route' => 'app_test_number', '_controller' => 'App\\Controller\\TestController::number'], null, null, null, false, false, null]],
        '/api/users' => [
            [['_route' => 'api.users.store', '_controller' => 'App\\User\\Presentation\\API\\User\\CreateUserController::store'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api.users.list', '_controller' => 'App\\User\\Presentation\\API\\User\\ListUserController::index'], null, ['GET' => 0], null, false, false, null],
        ],
        '/api/select-options' => [
            [['_route' => 'api.select-options.store', '_controller' => 'App\\User\\Presentation\\API\\SelectOption\\CreateSelectOptionController::store'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api.select-options.list', '_controller' => 'App\\User\\Presentation\\API\\SelectOption\\ListSelectOptionController::index'], null, ['GET' => 0], null, false, false, null],
        ],
        '/api/select-option-kinds' => [
            [['_route' => 'api.select-option-kinds.store', '_controller' => 'App\\User\\Presentation\\API\\SelectOptionKind\\CreateSelectOptionKindController::store'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api.select-options-kinds.list', '_controller' => 'App\\User\\Presentation\\API\\SelectOptionKind\\ListSelectOptionKindController::index'], null, ['GET' => 0], null, false, false, null],
        ],
        '/api/login_check' => [[['_route' => 'api_login_check'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/(?'
                    .'|users/(?'
                        .'|([^/]++)(?'
                            .'|/change\\-password(*:87)'
                            .'|(*:94)'
                        .')'
                        .'|register(*:110)'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|restore\\-deleted(*:149)'
                                .'|toggle\\-active(*:171)'
                                .'|avatar/upload(*:192)'
                            .')'
                            .'|(*:201)'
                        .')'
                    .')'
                    .'|addresses/users/([^/]++)(*:235)'
                    .'|select\\-option(?'
                        .'|s/(?'
                            .'|([^/]++)(*:273)'
                            .'|kinds(*:286)'
                            .'|([^/]++)(?'
                                .'|/restore\\-deleted(*:322)'
                                .'|(*:330)'
                            .')'
                        .')'
                        .'|\\-kinds/([^/]++)(?'
                            .'|(*:359)'
                            .'|/restore\\-deleted(*:384)'
                            .'|(*:392)'
                        .')'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        87 => [[['_route' => 'api.users.change_password', '_controller' => 'App\\User\\Presentation\\API\\User\\ChangeUserPasswordController::changePassword'], ['uuid'], ['PATCH' => 0], null, false, false, null]],
        94 => [[['_route' => 'api.users.destroy', '_controller' => 'App\\User\\Presentation\\API\\User\\DeleteUserController::destroy'], ['uuid'], ['DELETE' => 0], null, false, true, null]],
        110 => [[['_route' => 'api.users.register', '_controller' => 'App\\User\\Presentation\\API\\User\\RegisterUserController::register'], [], ['POST' => 0], null, false, false, null]],
        149 => [[['_route' => 'api.users.restore_deleted', '_controller' => 'App\\User\\Presentation\\API\\User\\RestoreDeletedUserController::restoreDeleted'], ['uuid'], ['PATCH' => 0], null, false, false, null]],
        171 => [[['_route' => 'api.users.toggle_active', '_controller' => 'App\\User\\Presentation\\API\\User\\ToggleActiveUserController::toggleActive'], ['uuid'], ['PATCH' => 0], null, false, false, null]],
        192 => [[['_route' => 'api.users.avatar_upload', '_controller' => 'App\\User\\Presentation\\API\\User\\UploadUserAvatarController::store'], ['uuid'], ['PATCH' => 0], null, false, false, null]],
        201 => [
            [['_route' => 'api.users.show', '_controller' => 'App\\User\\Presentation\\API\\User\\ShowUserController::show'], ['uuid'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api.users.update', '_controller' => 'App\\User\\Presentation\\API\\User\\UpdateUserController::update'], ['uuid'], ['PUT' => 0], null, false, true, null],
        ],
        235 => [[['_route' => 'api.addresses.users', '_controller' => 'App\\User\\Presentation\\API\\Address\\UserAddressesController::userAddresses'], ['uuid'], ['GET' => 0], null, false, true, null]],
        273 => [[['_route' => 'api.select-options.destroy', '_controller' => 'App\\User\\Presentation\\API\\SelectOption\\DeleteSelectOptionController::destroy'], ['uuid'], ['DELETE' => 0], null, false, true, null]],
        286 => [[['_route' => 'api.select-options-list-kinds.list', '_controller' => 'App\\User\\Presentation\\API\\SelectOption\\ListSelectOptionKindController::index'], [], ['GET' => 0], null, false, false, null]],
        322 => [[['_route' => 'api.select-options.restore_deleted', '_controller' => 'App\\User\\Presentation\\API\\SelectOption\\RestoreDeletedSelectOptionController::restoreDeleted'], ['uuid'], ['PATCH' => 0], null, false, false, null]],
        330 => [[['_route' => 'api.select-options.update', '_controller' => 'App\\User\\Presentation\\API\\SelectOption\\UpdateSelectOptionController::update'], ['uuid'], ['PUT' => 0], null, false, true, null]],
        359 => [[['_route' => 'api.select-option-kinds.destroy', '_controller' => 'App\\User\\Presentation\\API\\SelectOptionKind\\DeleteSelectOptionKindController::destroy'], ['uuid'], ['DELETE' => 0], null, false, true, null]],
        384 => [[['_route' => 'api.select-option-kinds.restore_deleted', '_controller' => 'App\\User\\Presentation\\API\\SelectOptionKind\\RestoreDeletedSelectOptionKindController::restoreDeleted'], ['uuid'], ['PATCH' => 0], null, false, false, null]],
        392 => [
            [['_route' => 'api.select-option-kinds.update', '_controller' => 'App\\User\\Presentation\\API\\SelectOptionKind\\UpdateSelectOptionKindController::update'], ['uuid'], ['PUT' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
