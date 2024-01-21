<?php

namespace ContainerVhmgMz5;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_L6qnxpxService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.l6qnxpx' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.l6qnxpx'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'restoreDeletedSelectOptionAction' => ['privates', 'App\\User\\Domain\\Action\\SelectOption\\RestoreDeletedSelectOptionAction', 'getRestoreDeletedSelectOptionActionService', true],
        ], [
            'restoreDeletedSelectOptionAction' => 'App\\User\\Domain\\Action\\SelectOption\\RestoreDeletedSelectOptionAction',
        ]);
    }
}