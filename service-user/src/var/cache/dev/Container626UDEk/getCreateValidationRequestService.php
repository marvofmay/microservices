<?php

namespace Container626UDEk;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getCreateValidationRequestService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\User\Presentation\Validation\User\Create\CreateValidationRequest' shared autowired service.
     *
     * @return \App\User\Presentation\Validation\User\Create\CreateValidationRequest
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/User/Presentation/Validation/User/Create/CreateValidationRequest.php';
        include_once \dirname(__DIR__, 4).'/src/User/Presentation/Validation/User/Create/CreateValidation.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/http-foundation/Request.php';
        include_once \dirname(__DIR__, 4).'/src/User/Presentation/Request/User/CreateRequest.php';

        return $container->privates['App\\User\\Presentation\\Validation\\User\\Create\\CreateValidationRequest'] = new \App\User\Presentation\Validation\User\Create\CreateValidationRequest(new \App\User\Presentation\Validation\User\Create\CreateValidation(($container->privates['App\\User\\Presentation\\Request\\User\\CreateRequest'] ??= new \App\User\Presentation\Request\User\CreateRequest()), ($container->privates['validator'] ?? self::getValidatorService($container))));
    }
}
