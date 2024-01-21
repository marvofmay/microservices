<?php

namespace ContainerHPkoESd;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getGetSelectOptionKindsQueryHandlerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\User\Application\QueryHandler\SelectOptionKind\GetSelectOptionKindsQueryHandler' shared autowired service.
     *
     * @return \App\User\Application\QueryHandler\SelectOptionKind\GetSelectOptionKindsQueryHandler
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/User/Application/QueryHandler/SelectOptionKind/GetSelectOptionKindsQueryHandler.php';

        return $container->privates['App\\User\\Application\\QueryHandler\\SelectOptionKind\\GetSelectOptionKindsQueryHandler'] = new \App\User\Application\QueryHandler\SelectOptionKind\GetSelectOptionKindsQueryHandler(($container->services['doctrine.orm.default_entity_manager'] ?? self::getDoctrine_Orm_DefaultEntityManagerService($container)));
    }
}
