<?php

namespace ContainerTyvOGFW;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getNotBlankValidator14Service extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'App\User\Presentation\Validation\User\Update\Password\NotBlankValidator' shared autowired service.
     *
     * @return \App\User\Presentation\Validation\User\Update\Password\NotBlankValidator
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/ConstraintValidatorInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/ConstraintValidator.php';
        include_once \dirname(__DIR__, 4).'/src/User/Presentation/Validation/User/Update/Password/NotBlankValidator.php';

        return $container->privates['App\\User\\Presentation\\Validation\\User\\Update\\Password\\NotBlankValidator'] = new \App\User\Presentation\Validation\User\Update\Password\NotBlankValidator();
    }
}
