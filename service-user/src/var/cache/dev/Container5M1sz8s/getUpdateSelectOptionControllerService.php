<?php

namespace Container5M1sz8s;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getUpdateSelectOptionControllerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\User\Presentation\API\SelectOption\UpdateSelectOptionController' shared autowired service.
     *
     * @return \App\User\Presentation\API\SelectOption\UpdateSelectOptionController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/User/Presentation/API/SelectOption/UpdateSelectOptionController.php';

        $container->services['App\\User\\Presentation\\API\\SelectOption\\UpdateSelectOptionController'] = $instance = new \App\User\Presentation\API\SelectOption\UpdateSelectOptionController(($container->privates['App\\User\\Domain\\Service\\SelectOption\\ReaderService\\SelectOptionReaderService'] ?? $container->load('getSelectOptionReaderServiceService')), ($container->privates['monolog.logger'] ?? self::getMonolog_LoggerService($container)));

        $instance->setContainer(($container->privates['.service_locator.O2p6Lk7'] ?? $container->load('get_ServiceLocator_O2p6Lk7Service'))->withContext('App\\User\\Presentation\\API\\SelectOption\\UpdateSelectOptionController', $container));

        return $instance;
    }
}
