<?php

namespace ContainerI3Rn32U;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getRestoreDeleteActionService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\User\Domain\Action\User\RestoreDeleteAction' shared autowired service.
     *
     * @return \App\User\Domain\Action\User\RestoreDeleteAction
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/User/Domain/Action/User/RestoreDeleteAction.php';

        return $container->privates['App\\User\\Domain\\Action\\User\\RestoreDeleteAction'] = new \App\User\Domain\Action\User\RestoreDeleteAction(($container->services['messenger.default_bus'] ?? $container->load('getMessenger_DefaultBusService')));
    }
}
