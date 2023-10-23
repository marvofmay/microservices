<?php

namespace App\User\Presentation\Validation\User\Register\FirstName;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MinLength extends Constraint
{
    public string $message = 'The value of firstName is too short. It should have at least 3 characters.';
    public int $minLength = 3;

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }
}