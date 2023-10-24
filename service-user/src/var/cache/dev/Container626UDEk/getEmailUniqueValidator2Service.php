<?php

namespace Container626UDEk;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getEmailUniqueValidator2Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\User\Presentation\Validation\User\Register\Email\EmailUniqueValidator' shared autowired service.
     *
     * @return \App\User\Presentation\Validation\User\Register\Email\EmailUniqueValidator
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/ConstraintValidatorInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/ConstraintValidator.php';
        include_once \dirname(__DIR__, 4).'/src/User/Presentation/Validation/User/Register/Email/EmailUniqueValidator.php';

        return $container->privates['App\\User\\Presentation\\Validation\\User\\Register\\Email\\EmailUniqueValidator'] = new \App\User\Presentation\Validation\User\Register\Email\EmailUniqueValidator(($container->privates['App\\User\\Domain\\Service\\ReaderService\\UserReaderService'] ?? $container->load('getUserReaderServiceService')));
    }
}
