<?php

namespace Container5M1sz8s;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getChangeUserPasswordControllerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\User\Presentation\API\User\ChangeUserPasswordController' shared autowired service.
     *
     * @return \App\User\Presentation\API\User\ChangeUserPasswordController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/User/Presentation/API/User/ChangeUserPasswordController.php';

        $container->services['App\\User\\Presentation\\API\\User\\ChangeUserPasswordController'] = $instance = new \App\User\Presentation\API\User\ChangeUserPasswordController(($container->privates['App\\User\\Domain\\Service\\User\\ReaderService\\UserReaderService'] ?? $container->load('getUserReaderServiceService')), ($container->privates['monolog.logger'] ?? self::getMonolog_LoggerService($container)), ($container->privates['security.user_password_hasher'] ?? $container->load('getSecurity_UserPasswordHasherService')));

        $instance->setContainer(($container->privates['.service_locator.O2p6Lk7'] ?? $container->load('get_ServiceLocator_O2p6Lk7Service'))->withContext('App\\User\\Presentation\\API\\User\\ChangeUserPasswordController', $container));

        return $instance;
    }
}
