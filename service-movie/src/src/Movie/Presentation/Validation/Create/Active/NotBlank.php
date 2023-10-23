<?php

namespace App\Movie\Presentation\Validation\Create\Active;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotBlank extends Constraint
{
    public string $message = 'Active is required';

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }
}