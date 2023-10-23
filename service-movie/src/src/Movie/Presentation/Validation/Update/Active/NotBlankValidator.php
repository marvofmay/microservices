<?php

namespace App\Movie\Presentation\Validation\Update\Active;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NotBlankValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (! is_bool($value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}