<?php

namespace Container626UDEk;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getEmailValidator2Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\User\Presentation\Validation\User\Register\Email\EmailValidator' shared autowired service.
     *
     * @return \App\User\Presentation\Validation\User\Register\Email\EmailValidator
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/ConstraintValidatorInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/ConstraintValidator.php';
        include_once \dirname(__DIR__, 4).'/src/User/Presentation/Validation/User/Register/Email/EmailValidator.php';

        return $container->privates['App\\User\\Presentation\\Validation\\User\\Register\\Email\\EmailValidator'] = new \App\User\Presentation\Validation\User\Register\Email\EmailValidator();
    }
}
