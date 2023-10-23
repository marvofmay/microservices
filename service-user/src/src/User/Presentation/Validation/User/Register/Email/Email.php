<?php

namespace App\User\Presentation\Validation\User\Register\Email;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Email extends Constraint
{
    public string $message = 'Invalid email format';

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }
}