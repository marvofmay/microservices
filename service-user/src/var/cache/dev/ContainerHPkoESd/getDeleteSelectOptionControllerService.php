<?php

namespace ContainerHPkoESd;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDeleteSelectOptionControllerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\User\Presentation\API\SelectOption\DeleteSelectOptionController' shared autowired service.
     *
     * @return \App\User\Presentation\API\SelectOption\DeleteSelectOptionController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/User/Presentation/API/SelectOption/DeleteSelectOptionController.php';

        $container->services['App\\User\\Presentation\\API\\SelectOption\\DeleteSelectOptionController'] = $instance = new \App\User\Presentation\API\SelectOption\DeleteSelectOptionController(($container->privates['monolog.logger'] ?? self::getMonolog_LoggerService($container)), ($container->privates['App\\User\\Domain\\Service\\SelectOption\\ReaderService\\SelectOptionReaderService'] ?? $container->load('getSelectOptionReaderServiceService')));

        $instance->setContainer(($container->privates['.service_locator.O2p6Lk7'] ?? $container->load('get_ServiceLocator_O2p6Lk7Service'))->withContext('App\\User\\Presentation\\API\\SelectOption\\DeleteSelectOptionController', $container));

        return $instance;
    }
}