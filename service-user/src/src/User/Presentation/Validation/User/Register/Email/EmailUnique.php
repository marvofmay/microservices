<?php

namespace App\User\Presentation\Validation\User\Register\Email;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class EmailUnique extends Constraint
{
    public string $message = 'Email is used by some user';

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }
}