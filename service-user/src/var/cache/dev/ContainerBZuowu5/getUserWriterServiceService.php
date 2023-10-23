<?php

namespace ContainerBZuowu5;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getUserWriterServiceService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\User\Domain\Service\WriterService\UserWriterService' shared autowired service.
     *
     * @return \App\User\Domain\Service\WriterService\UserWriterService
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/User/Domain/Service/WriterService/UserWriterService.php';

        return $container->privates['App\\User\\Domain\\Service\\WriterService\\UserWriterService'] = new \App\User\Domain\Service\WriterService\UserWriterService(($container->privates['App\\User\\Domain\\Repository\\WriterRepository\\UserWriterRepository'] ?? $container->load('getUserWriterRepositoryService')));
    }
}
