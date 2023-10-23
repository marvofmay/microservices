<?php

namespace App\User\Presentation\Validation\User\Register;

class RegisterValidationRequest
{
    private RegisterValidation $registerValidation;

    public function __construct(RegisterValidation $registerValidation)
    {
        $this->registerValidation = $registerValidation;
    }

    public function validate(): array
    {
        return $this->registerValidation
            ->validateFirstName()
            ->validateLastName()
            ->validatePhone()
            ->validateEmail()
            ->validateEmailUnique()
            ->validatePassword()
            ->getErrorsMessages();
    }
}