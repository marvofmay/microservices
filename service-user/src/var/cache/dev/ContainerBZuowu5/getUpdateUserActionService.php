<?php

namespace ContainerBZuowu5;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getUpdateUserActionService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\User\Domain\Action\User\UpdateUserAction' shared autowired service.
     *
     * @return \App\User\Domain\Action\User\UpdateUserAction
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/User/Domain/Action/User/UpdateUserAction.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/http-foundation/Request.php';
        include_once \dirname(__DIR__, 4).'/src/User/Presentation/Request/User/UpdateRequest.php';

        return $container->privates['App\\User\\Domain\\Action\\User\\UpdateUserAction'] = new \App\User\Domain\Action\User\UpdateUserAction(($container->privates['App\\User\\Presentation\\Request\\User\\UpdateRequest'] ??= new \App\User\Presentation\Request\User\UpdateRequest()), ($container->services['messenger.default_bus'] ?? $container->load('getMessenger_DefaultBusService')));
    }
}
