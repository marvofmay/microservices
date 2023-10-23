<?php

namespace ContainerBZuowu5;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getConsole_Command_MessengerDebugService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'console.command.messenger_debug' shared service.
     *
     * @return \Symfony\Component\Messenger\Command\DebugCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/Command.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/messenger/Command/DebugCommand.php';

        $container->privates['console.command.messenger_debug'] = $instance = new \Symfony\Component\Messenger\Command\DebugCommand(['messenger.bus.default' => ['App\\User\\Application\\Command\\User\\CreateUserCommand' => [['App\\User\\Application\\CommandHandler\\User\\CreateUserCommandHandler', ['bus' => 'messenger.bus.default']]], 'App\\User\\Application\\Command\\User\\DeleteUserCommand' => [['App\\User\\Application\\CommandHandler\\User\\DeleteUserCommandHandler', ['bus' => 'messenger.bus.default']]], 'App\\User\\Application\\Command\\User\\RegisterUserCommand' => [['App\\User\\Application\\CommandHandler\\User\\RegisterUserCommandHandler', ['bus' => 'messenger.bus.default']]], 'App\\User\\Application\\Command\\User\\UpdateUserCommand' => [['App\\User\\Application\\CommandHandler\\User\\UpdateUserCommandHandler', ['bus' => 'messenger.bus.default']]], 'Symfony\\Component\\Messenger\\Message\\RedispatchMessage' => [['messenger.redispatch_message_handler', []]]]]);

        $instance->setName('debug:messenger');
        $instance->setDescription('List messages you can dispatch using the message buses');

        return $instance;
    }
}
