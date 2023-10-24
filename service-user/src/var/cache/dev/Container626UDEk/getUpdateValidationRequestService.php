<?php

namespace Container626UDEk;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getUpdateValidationRequestService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\User\Presentation\Validation\User\Update\UpdateValidationRequest' shared autowired service.
     *
     * @return \App\User\Presentation\Validation\User\Update\UpdateValidationRequest
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/User/Presentation/Validation/User/Update/UpdateValidationRequest.php';
        include_once \dirname(__DIR__, 4).'/src/User/Presentation/Validation/User/Update/UpdateValidation.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/http-foundation/Request.php';
        include_once \dirname(__DIR__, 4).'/src/User/Presentation/Request/User/UpdateRequest.php';

        return $container->privates['App\\User\\Presentation\\Validation\\User\\Update\\UpdateValidationRequest'] = new \App\User\Presentation\Validation\User\Update\UpdateValidationRequest(new \App\User\Presentation\Validation\User\Update\UpdateValidation(($container->privates['validator'] ?? self::getValidatorService($container)), ($container->privates['App\\User\\Presentation\\Request\\User\\UpdateRequest'] ??= new \App\User\Presentation\Request\User\UpdateRequest())));
    }
}
