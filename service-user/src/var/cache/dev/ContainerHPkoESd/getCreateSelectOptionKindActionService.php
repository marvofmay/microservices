<?php

namespace ContainerHPkoESd;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getCreateSelectOptionKindActionService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\User\Domain\Action\SelectOptionKind\CreateSelectOptionKindAction' shared autowired service.
     *
     * @return \App\User\Domain\Action\SelectOptionKind\CreateSelectOptionKindAction
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/User/Domain/Action/SelectOptionKind/CreateSelectOptionKindAction.php';

        return $container->privates['App\\User\\Domain\\Action\\SelectOptionKind\\CreateSelectOptionKindAction'] = new \App\User\Domain\Action\SelectOptionKind\CreateSelectOptionKindAction(($container->services['messenger.default_bus'] ?? $container->load('getMessenger_DefaultBusService')));
    }
}
