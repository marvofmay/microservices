<?php

namespace App\User\Presentation\Validation\User\Create\Roles;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NotBlankValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (empty($value)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
        foreach ($value as $role) {
            if (! in_array($role, ['ROLE_USER', 'ROLE_MODERATOR', 'ROLE_ADMIN'])) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }
        }
    }
}