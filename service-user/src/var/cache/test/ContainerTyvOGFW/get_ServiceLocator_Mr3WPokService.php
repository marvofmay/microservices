<?php

namespace ContainerTyvOGFW;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_Mr3WPokService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private '.service_locator.Mr3WPok' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.Mr3WPok'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'App\\Kernel::loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\Kernel::registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\User\\Presentation\\API\\UserController::destroy' => ['privates', '.service_locator.Za3oEHn', 'get_ServiceLocator_Za3oEHnService', true],
            'App\\User\\Presentation\\API\\UserController::index' => ['privates', '.service_locator.wTlZBDt', 'get_ServiceLocator_WTlZBDtService', true],
            'App\\User\\Presentation\\API\\UserController::store' => ['privates', '.service_locator.0dgqFke', 'get_ServiceLocator_0dgqFkeService', true],
            'App\\User\\Presentation\\API\\UserController::update' => ['privates', '.service_locator.yBjwbE7', 'get_ServiceLocator_YBjwbE7Service', true],
            'kernel::loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel::registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\User\\Presentation\\API\\UserController:destroy' => ['privates', '.service_locator.Za3oEHn', 'get_ServiceLocator_Za3oEHnService', true],
            'App\\User\\Presentation\\API\\UserController:index' => ['privates', '.service_locator.wTlZBDt', 'get_ServiceLocator_WTlZBDtService', true],
            'App\\User\\Presentation\\API\\UserController:store' => ['privates', '.service_locator.0dgqFke', 'get_ServiceLocator_0dgqFkeService', true],
            'App\\User\\Presentation\\API\\UserController:update' => ['privates', '.service_locator.yBjwbE7', 'get_ServiceLocator_YBjwbE7Service', true],
            'kernel:loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel:registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
        ], [
            'App\\Kernel::loadRoutes' => '?',
            'App\\Kernel::registerContainerConfiguration' => '?',
            'App\\User\\Presentation\\API\\UserController::destroy' => '?',
            'App\\User\\Presentation\\API\\UserController::index' => '?',
            'App\\User\\Presentation\\API\\UserController::store' => '?',
            'App\\User\\Presentation\\API\\UserController::update' => '?',
            'kernel::loadRoutes' => '?',
            'kernel::registerContainerConfiguration' => '?',
            'App\\User\\Presentation\\API\\UserController:destroy' => '?',
            'App\\User\\Presentation\\API\\UserController:index' => '?',
            'App\\User\\Presentation\\API\\UserController:store' => '?',
            'App\\User\\Presentation\\API\\UserController:update' => '?',
            'kernel:loadRoutes' => '?',
            'kernel:registerContainerConfiguration' => '?',
        ]);
    }
}
