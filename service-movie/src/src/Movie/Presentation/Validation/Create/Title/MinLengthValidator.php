<?php

namespace App\Movie\Presentation\Validation\Create\Title;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MinLengthValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (strlen($value) < $constraint->minLength) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}