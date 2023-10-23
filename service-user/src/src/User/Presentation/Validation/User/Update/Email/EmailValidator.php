<?php

namespace App\User\Presentation\Validation\User\Update\Email;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EmailValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}