<?php

namespace ContainerHPkoESd;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_Messenger_HandlerDescriptor_WK_SXjbService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.messenger.handler_descriptor.WK.sXjb' shared service.
     *
     * @return \Symfony\Component\Messenger\Handler\HandlerDescriptor
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/messenger/Handler/HandlerDescriptor.php';
        include_once \dirname(__DIR__, 4).'/src/User/Application/CommandHandler/SelectOptionKind/DeleteSelectOptionKindCommandHandler.php';

        return $container->privates['.messenger.handler_descriptor.WK.sXjb'] = new \Symfony\Component\Messenger\Handler\HandlerDescriptor(new \App\User\Application\CommandHandler\SelectOptionKind\DeleteSelectOptionKindCommandHandler(($container->services['doctrine.orm.default_entity_manager'] ?? self::getDoctrine_Orm_DefaultEntityManagerService($container))), ['bus' => 'messenger.bus.default']);
    }
}