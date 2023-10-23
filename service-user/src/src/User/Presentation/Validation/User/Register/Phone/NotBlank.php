<?php

namespace App\User\Presentation\Validation\User\Register\Phone;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotBlank extends Constraint
{
    public string $message = 'Invalid phone number';

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }
}