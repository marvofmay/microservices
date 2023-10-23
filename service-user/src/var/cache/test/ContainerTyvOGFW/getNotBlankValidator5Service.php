<?php

namespace ContainerTyvOGFW;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getNotBlankValidator5Service extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'App\User\Presentation\Validation\User\Create\Phone\NotBlankValidator' shared autowired service.
     *
     * @return \App\User\Presentation\Validation\User\Create\Phone\NotBlankValidator
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/ConstraintValidatorInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/ConstraintValidator.php';
        include_once \dirname(__DIR__, 4).'/src/User/Presentation/Validation/User/Create/Phone/NotBlankValidator.php';

        return $container->privates['App\\User\\Presentation\\Validation\\User\\Create\\Phone\\NotBlankValidator'] = new \App\User\Presentation\Validation\User\Create\Phone\NotBlankValidator();
    }
}
