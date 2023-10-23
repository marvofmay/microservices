<?php

namespace App\Movie\Presentation\Validation\Create\Title;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotBlank extends Constraint
{
    public string $message = 'Title cannot be blank';

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }
}