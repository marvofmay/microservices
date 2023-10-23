<?php

namespace App\User\Presentation\Validation\User\Update\UUID;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotBlank extends Constraint
{
    public string $message = 'uuid cannot be blank';

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }
}