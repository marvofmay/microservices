<?php

namespace ContainerBZuowu5;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_Messenger_HandlerDescriptor_1QcaYZYService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.messenger.handler_descriptor.1QcaYZY' shared service.
     *
     * @return \Symfony\Component\Messenger\Handler\HandlerDescriptor
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/messenger/Handler/HandlerDescriptor.php';
        include_once \dirname(__DIR__, 4).'/src/User/Application/CommandHandler/User/RegisterUserCommandHandler.php';

        return $container->privates['.messenger.handler_descriptor.1QcaYZY'] = new \Symfony\Component\Messenger\Handler\HandlerDescriptor(new \App\User\Application\CommandHandler\User\RegisterUserCommandHandler(($container->privates['App\\User\\Domain\\Service\\WriterService\\UserWriterService'] ?? $container->load('getUserWriterServiceService')), ($container->privates['security.user_password_hasher'] ?? $container->load('getSecurity_UserPasswordHasherService'))), ['bus' => 'messenger.bus.default']);
    }
}
