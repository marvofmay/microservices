<?php

namespace Container626UDEk;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getMessenger_Transport_RabbitmqUserRegisterService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'messenger.transport.rabbitmq_user_register' shared service.
     *
     * @return \Symfony\Component\Messenger\Transport\TransportInterface
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/messenger/Transport/Receiver/ReceiverInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/messenger/Transport/Sender/SenderInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/messenger/Transport/TransportInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/messenger/Transport/TransportFactoryInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/messenger/Transport/TransportFactory.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/messenger/Transport/Serialization/SerializerInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/messenger/Transport/Serialization/PhpSerializer.php';

        return $container->privates['messenger.transport.rabbitmq_user_register'] = (new \Symfony\Component\Messenger\Transport\TransportFactory(new RewindableGenerator(function () use ($container) {
            yield 0 => (new \Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpTransportFactory());
            yield 1 => ($container->privates['messenger.transport.sync.factory'] ?? $container->load('getMessenger_Transport_Sync_FactoryService'));
            yield 2 => ($container->privates['messenger.transport.in_memory.factory'] ??= new \Symfony\Component\Messenger\Transport\InMemory\InMemoryTransportFactory());
            yield 3 => $container->load('getMessenger_Transport_Doctrine_FactoryService');
        }, 4)))->createTransport($container->getEnv('string:MESSENGER_TRANSPORT_DSN').'/user_register', ['exchange' => ['name' => 'user_register', 'type' => 'direct'], 'transport_name' => 'rabbitmq_user_register'], new \Symfony\Component\Messenger\Transport\Serialization\PhpSerializer());
    }
}
