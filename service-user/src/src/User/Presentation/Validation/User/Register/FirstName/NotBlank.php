<?php

namespace App\User\Presentation\Validation\User\Register\FirstName;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotBlank extends Constraint
{
    public string $message = 'firstName cannot be blank';

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }
}