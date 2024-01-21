<?php

namespace ContainerVhmgMz5;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_Messenger_HandlerDescriptor_8XMalI3Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.messenger.handler_descriptor.8XMalI3' shared service.
     *
     * @return \Symfony\Component\Messenger\Handler\HandlerDescriptor
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/messenger/Handler/HandlerDescriptor.php';
        include_once \dirname(__DIR__, 4).'/src/User/Application/CommandHandler/SelectOptionKind/UpdateSelectOptionKindCommandHandler.php';
        include_once \dirname(__DIR__, 4).'/src/User/Domain/Entity/SelectOptionKind.php';

        return $container->privates['.messenger.handler_descriptor.8XMalI3'] = new \Symfony\Component\Messenger\Handler\HandlerDescriptor(new \App\User\Application\CommandHandler\SelectOptionKind\UpdateSelectOptionKindCommandHandler(($container->privates['App\\User\\Domain\\Service\\SelectOptionKind\\WriterService\\SelectOptionKindWriterService'] ?? $container->load('getSelectOptionKindWriterServiceService')), ($container->privates['App\\User\\Domain\\Entity\\SelectOptionKind'] ??= new \App\User\Domain\Entity\SelectOptionKind())), ['bus' => 'messenger.bus.default']);
    }
}
