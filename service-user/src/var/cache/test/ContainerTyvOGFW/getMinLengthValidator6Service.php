<?php

namespace ContainerTyvOGFW;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getMinLengthValidator6Service extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'App\User\Presentation\Validation\User\Update\LastName\MinLengthValidator' shared autowired service.
     *
     * @return \App\User\Presentation\Validation\User\Update\LastName\MinLengthValidator
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/ConstraintValidatorInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/ConstraintValidator.php';
        include_once \dirname(__DIR__, 4).'/src/User/Presentation/Validation/User/Update/LastName/MinLengthValidator.php';

        return $container->privates['App\\User\\Presentation\\Validation\\User\\Update\\LastName\\MinLengthValidator'] = new \App\User\Presentation\Validation\User\Update\LastName\MinLengthValidator();
    }
}
