<?php

namespace App\User\Presentation\Validation\User\Create;

class CreateValidationRequest
{
    private CreateValidation $createValidation;

    public function __construct(CreateValidation $createValidation)
    {
        $this->createValidation = $createValidation;
    }

    public function validate(): array
    {
        return $this->createValidation
            ->validateFirstName()
            ->validateLastName()
            ->validatePhone()
            ->validateEmail()
            ->validateEmailUnique()
            ->validatePassword()
            ->validateActive()
            ->validateRoles()
            ->getErrorsMessages();
    }
}