<?php

namespace App\Movie\Presentation\Validation\Create\Title;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MinLength extends Constraint
{
    public string $message = 'The title is too short. It should have at least 3 characters.';
    public int $minLength = 3;

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }
}