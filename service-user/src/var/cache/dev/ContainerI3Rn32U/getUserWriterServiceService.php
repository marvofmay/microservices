<?php

namespace ContainerI3Rn32U;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getUserWriterServiceService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\User\Domain\Service\User\WriterService\UserWriterService' shared autowired service.
     *
     * @return \App\User\Domain\Service\User\WriterService\UserWriterService
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/User/Domain/Service/User/WriterService/UserWriterService.php';

        return $container->privates['App\\User\\Domain\\Service\\User\\WriterService\\UserWriterService'] = new \App\User\Domain\Service\User\WriterService\UserWriterService(($container->privates['App\\User\\Domain\\Repository\\User\\WriterRepository\\UserWriterRepository'] ?? $container->load('getUserWriterRepositoryService')));
    }
}
