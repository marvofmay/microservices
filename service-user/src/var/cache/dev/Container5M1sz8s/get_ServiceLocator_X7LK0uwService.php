<?php

namespace Container5M1sz8s;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_X7LK0uwService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.X7LK0uw' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.X7LK0uw'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'updateDTO' => ['privates', 'App\\User\\Domain\\DTO\\SelectOption\\UpdateDTO', 'getUpdateDTO2Service', true],
            'updateSelectOptionAction' => ['privates', 'App\\User\\Domain\\Action\\SelectOption\\UpdateSelectOptionAction', 'getUpdateSelectOptionActionService', true],
        ], [
            'updateDTO' => 'App\\User\\Domain\\DTO\\SelectOption\\UpdateDTO',
            'updateSelectOptionAction' => 'App\\User\\Domain\\Action\\SelectOption\\UpdateSelectOptionAction',
        ]);
    }
}
