<?php

namespace App\User\Presentation\Validation\User\Register\Password;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotBlank extends Constraint
{
    public string $message = 'password cannot be blank';

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }
}