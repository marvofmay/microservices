<?php

namespace ContainerTyvOGFW;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getGetUsersQueryHandlerService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'App\User\Application\QueryHandler\User\GetUsersQueryHandler' shared autowired service.
     *
     * @return \App\User\Application\QueryHandler\User\GetUsersQueryHandler
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/User/Application/QueryHandler/User/GetUsersQueryHandler.php';

        return $container->privates['App\\User\\Application\\QueryHandler\\User\\GetUsersQueryHandler'] = new \App\User\Application\QueryHandler\User\GetUsersQueryHandler(($container->services['doctrine.orm.default_entity_manager'] ?? self::getDoctrine_Orm_DefaultEntityManagerService($container)));
    }
}
