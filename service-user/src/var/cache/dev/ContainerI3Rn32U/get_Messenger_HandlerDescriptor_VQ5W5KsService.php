<?php

namespace ContainerI3Rn32U;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_Messenger_HandlerDescriptor_VQ5W5KsService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.messenger.handler_descriptor.VQ5W5Ks' shared service.
     *
     * @return \Symfony\Component\Messenger\Handler\HandlerDescriptor
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/messenger/Handler/HandlerDescriptor.php';
        include_once \dirname(__DIR__, 4).'/src/User/Application/CommandHandler/SelectOption/CreateSelectOptionCommandHandler.php';

        return $container->privates['.messenger.handler_descriptor.VQ5W5Ks'] = new \Symfony\Component\Messenger\Handler\HandlerDescriptor(new \App\User\Application\CommandHandler\SelectOption\CreateSelectOptionCommandHandler(($container->privates['App\\User\\Domain\\Service\\SelectOption\\WriterService\\SelectOptionWriterService'] ?? $container->load('getSelectOptionWriterServiceService'))), ['bus' => 'messenger.bus.default']);
    }
}
