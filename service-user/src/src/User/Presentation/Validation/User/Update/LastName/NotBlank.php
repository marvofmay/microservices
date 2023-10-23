<?php

namespace App\User\Presentation\Validation\User\Update\LastName;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotBlank extends Constraint
{
    public string $message = 'Invalid LastName';

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }
}