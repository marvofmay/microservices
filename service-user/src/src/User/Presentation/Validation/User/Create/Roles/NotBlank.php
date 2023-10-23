<?php

namespace App\User\Presentation\Validation\User\Create\Roles;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotBlank extends Constraint
{
    public $message = 'Roles are required';

    public function validatedBy()
    {
        return static::class.'Validator';
    }
}