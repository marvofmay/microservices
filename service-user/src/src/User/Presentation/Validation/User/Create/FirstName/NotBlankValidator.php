<?php

namespace App\User\Presentation\Validation\User\Create\FirstName;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NotBlankValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (empty($value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}