<?php

namespace App\User\Presentation\Validation\User\Update;

use App\User\Presentation\Request\User\UpdateRequest;

class UpdateValidationRequest
{
    private UpdateValidation $updateValidation;

    public function __construct(UpdateValidation $updateValidation)
    {
        $this->updateValidation = $updateValidation;
    }

    public function getUpdateRequest(): UpdateRequest
    {
        return $this->updateValidation->getUpdateRequest();
    }

    public function validate(): array
    {
        return $this->updateValidation
            ->validateUUID()
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