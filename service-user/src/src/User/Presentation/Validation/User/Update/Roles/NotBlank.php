<?php

namespace App\User\Presentation\Validation\User\Update\Roles;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotBlank extends Constraint
{
    public string $message = 'Roles are required';

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }
}