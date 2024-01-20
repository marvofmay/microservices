<?php

namespace ContainerI3Rn32U;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_QYW0vF4Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.QYW0vF4' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.QYW0vF4'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'changePasswordDTO' => ['privates', 'App\\User\\Domain\\DTO\\User\\ChangePasswordDTO', 'getChangePasswordDTOService', true],
            'changeUserPasswordAction' => ['privates', 'App\\User\\Domain\\Action\\User\\ChangeUserPasswordAction', 'getChangeUserPasswordActionService', true],
        ], [
            'changePasswordDTO' => 'App\\User\\Domain\\DTO\\User\\ChangePasswordDTO',
            'changeUserPasswordAction' => 'App\\User\\Domain\\Action\\User\\ChangeUserPasswordAction',
        ]);
    }
}
