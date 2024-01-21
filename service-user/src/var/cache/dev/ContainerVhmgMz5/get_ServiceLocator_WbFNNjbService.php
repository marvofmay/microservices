<?php

namespace ContainerVhmgMz5;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_WbFNNjbService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.WbFNNjb' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.WbFNNjb'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'updateDTO' => ['privates', 'App\\User\\Domain\\DTO\\SelectOptionKind\\UpdateDTO', 'getUpdateDTO2Service', true],
            'updateSelectOptionAction' => ['privates', 'App\\User\\Domain\\Action\\SelectOptionKind\\UpdateSelectOptionKindAction', 'getUpdateSelectOptionKindActionService', true],
        ], [
            'updateDTO' => 'App\\User\\Domain\\DTO\\SelectOptionKind\\UpdateDTO',
            'updateSelectOptionAction' => 'App\\User\\Domain\\Action\\SelectOptionKind\\UpdateSelectOptionKindAction',
        ]);
    }
}
